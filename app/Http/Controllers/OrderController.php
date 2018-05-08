<?php

namespace App\Http\Controllers;

use App\Bill;
use App\Book;
use App\Cart;
use App\Employee;
use App\Order;
use App\Order_item;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $book;
    private $order;
    private $order_item;

    public function __construct(Book $book, Order $order, Order_item $order_item) {
//        $user = Auth::check();
//        $this->user = $user;
        $this->book =$book;
        $this->order = $order;
        $this->order_item = $order_item;
    }

    public function showUserOrder() {
        session()->flash('page', '/user/order');
        $user = Auth::user();
        $orders = Order::where('user_id', '=', $user->id)->orderBy('created_at', 'desc')->paginate(3);
        $page = $orders->currentPage();
        if($page > 1) session()->forget('page');
//        return $orders;
        return view('order.showUserOrder', compact('orders'));
    }

    public function showOptionOrder($status) {
        $user = Auth::user();
        $orders = new Order();
        if($status === "waitting") {
            $orders = Order::where('user_id', '=', $user->id)
                ->whereNotIn('id', Bill::all()->pluck('order_id'))->orderBy('created_at', 'desc')->paginate(3);
        }
        if($status === "shipping") {
            $orders = Order::where('user_id', '=', $user->id)
                ->whereIn('id', Bill::where('was_paid', '=', 0)->pluck('order_id'))->orderBy('created_at', 'desc')->paginate(3);
        }

        if($status === "waspaid") {
            $orders = Order::where('user_id', '=', $user->id)
                ->whereIn('id', Bill::where('was_paid', '=', 1)->pluck('order_id'))->orderBy('created_at', 'desc')->paginate(3);
        }
        return view('order.showOptionOrder', compact('orders'));
    }

    public function addSession(Request $request) {
        //        session()->flush();
        $check = ['id', 'user_id', 'name', 'phone', 'email', 'address', 'created_at', 'updated_at'];
        if(session()->has('field') && !in_array(session()->get('field'), $check)) session()->forget('field');
        if(session()->has('search') && !in_array(session()->get('search'), $check)) session()->forget('search');

        $request->session()->flash('search', $request
            ->has('search') ? $request->get('search') : ($request->session()
            ->has('search') ? $request->session()->get('search') : ''));

        $request->session()->flash('field', $request
            ->has('field') ? $request->get('field') : ($request->session()
            ->has('field') ? $request->session()->get('field') : 'updated_at'));

        $request->session()->flash('sort', $request
            ->has('sort') ? $request->get('sort') : ($request->session()
            ->has('sort') ? $request->session()->get('sort') : 'asc'));
    }

    public function index(Request $request)
    {
        $this->addSession($request);

//        $orders = new Order();
        $orders = Order::with('order_items')->whereNotIn('orders.id', Bill::where('was_paid', '=', '1')->pluck('order_id'))
            ->where('name', 'like', '%'.$request->session()->get('search').'%')
            ->orderBy($request->session()->get('field'), $request->session()->get('sort'))->paginate(5);
        $page = $orders->currentPage();
//        return $orders;

        $employees = Employee::with('user')->where('position_id', '=', '3')->orderBy('employee_code')->get();
//        return $employees;
        if($request->ajax()) {
            return view('order.index', compact('orders', 'page', 'employees'));
        }else {
            return view('order.ajax', compact('orders', 'page', 'employees'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        return view('order.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'address' => 'required|max:500',
            'phone' => 'required|phone|min:10|max:15'
        ]);
        $user = Auth::user();
        $carts = $user->bookCarts;
        $items = array();
        foreach($carts as $key => $value) {
            $items[] = new Order_item([
                'book_code' => $value->book_code,
                'name' => $value->name,
                'price' => $value->price,
                'discount' => $value->discount,
                'quantity' => $value->pivot->quantity,
            ]);
        }
//        DB::transaction(function () use ($request, $user, $items){
//            $order = new Order();
//            $order->user_id = $user->id;
//            $order->name = $user->name;
//            $order->phone = $request->phone;
//            $order->email = $user->email;
//            $order->address = $request->address;
//            $order->save();
//            $order->orderItems()->saveMany($items);
//            foreach ($items as $item) {
//                $book = Book::where('book_code', '=', $item->book_code)->first();
//                $book->quantity -= $item->quantity;
//                $book->save();
//            }
//            Cart::where('user_id', '=', $user->id)->delete();
//        });
        DB::beginTransaction();
        try{
            $order = new Order();
            $order->user_id = $user->id;
            $order->name = $user->name;
            $order->phone = $request->phone;
            $order->email = $user->email;
            $order->address = $request->address;
            $order->save();
            $order->order_items()->saveMany($items);
            foreach ($items as $item) {
                $book = Book::where('book_code', '=', $item->book_code)->first();
                $book->quantity -= $item->quantity;
                $book->save();
            }
            Cart::where('user_id', '=', $user->id)->delete();
            DB::commit();
        }catch (\Exception $e) {
            DB::rollBack();
            session()->flash('message', $e);
            return redirect()->route('cart.index');
        }
        session()->flash('message', 'Thêm đơn hàng thành công!');
        return redirect()->route('user.order');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        DB::beginTransaction();
        try {
            $order = Order::find($request->id);
            $items = $order->order_items;
            foreach ($items as $item) {
                $book = Book::where('book_code', '=', $item->book_code)->first();
                $book->quantity += $item->quantity;
                $book->save();
                Order_item::destroy($item->id);
            }
            Order::destroy($request->id);
            DB::commit();
//            session()->flash('page', '/user/order');
            return redirect()->route('user.showOrder');
        }catch (\Exception $e) {
            DB::rollBack();
            return $e;
        }
    }
}
