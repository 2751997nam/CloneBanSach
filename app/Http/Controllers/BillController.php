<?php

namespace App\Http\Controllers;

use App\Bill;
use App\Book;
use App\Order;
use App\Order_item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function PHPSTORM_META\type;

class BillController extends Controller
{


    public function addSession(Request $request) {
        //        session()->flush();
        $check = ['id', 'bill_code', 'employee_code', 'order_id', 'was_paid', 'total', 'created_at', 'updated_at'];
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

        $bills = new Bill();
//        $orders = Order_item::select('order_id', 'SUM(order_items.price * order_items.quantity * (100 - order_items.discount) / 100) as total'
//            )->groupBy('order_id')->get();
//        $orders = DB::query('select `order_id`, SUM( `order_items`.`price` * `order_items`.`quantity` * (100 - `order_items`.`discount`) / 100) as `total`
//                              from `order_items`
//                              group by `order_id`');
//        return $orders;


        $bills = $bills->leftjoin(DB::raw('(select `order_id`, SUM( `order_items`.`price` * `order_items`.`quantity` * (100 - `order_items`.`discount`) / 100) as `total` 
                              from `order_items` 
                              group by `order_id`) as totals'), 'bills.order_id' , '=' , 'totals.order_id')->where('bill_code', 'like', '%'.$request->session()->get('search').'%')
                ->orderBy($request->session()->get('field'), $request->session()->get('sort'))->paginate(5);
//        return $bills;

        $page = $bills->currentPage();
        if($request->ajax()) {
            return view('bill.index', compact('bills', 'page'));
        }else {
            return view('bill.ajax', compact('bills', 'page'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'employee_code' => 'required',
            'order_id' => 'required'
        ]);

        $bill = new Bill();
        $b = Bill::orderBy('id', 'desc')->first();
        $b = (int) $b->id + 1;
        $bill->bill_code = $b < 10 ? "B00000".$b : ($b < 100 ? "B0000".$b : ($b < 1000 ? "B000".$b : ($b < 10000 ? "B00".$b : ($b < 100000 ? "B0".$b : "B".$b))));
        $bill->employee_code = $request->employee_code;
        $bill->order_id = $request->order_id;
        $bill->was_paid = 0;
        $bill->save();
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
        $this->validate($request, [
            'was_paid' => 'numeric'
        ]);

        $bill = Bill::find($id);
        $bill->was_paid = $request->was_paid;
        $bill->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bill = Bill::find($id);
        DB::beginTransaction();
        try {
            $order = Order::find($bill->order_id);
            $items = $order->order_items;
            foreach ($items as $item) {
                if($bill->was_paid == 0) {
                    $book = Book::where('book_code', '=', $item->book_code)->first();
                    $book->quantity += $item->quantity;
                    $book->save();
                }
                Order_item::destroy($item->id);
            }
            Order::destroy($bill->order_id);
            Bill::destroy($id);
            DB::commit();
        }catch (\Exception $e) {
            DB::rollBack();
            return $e;
        }
        return redirect('bills');
    }
}
