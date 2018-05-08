<?php

namespace App\Http\Controllers;

use App\Book;
use App\Cart;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = null;
        $carts = null;
        if (Auth::check()) {
            $user = Auth::user();
            $carts = $user->bookCarts;
        }
        return view('cart.cart', compact('user', 'carts'));
    }
    public function dropdownCart() {
        $user = null;
        $carts = null;
        if (Auth::check()) {
            $user = Auth::user();
            $carts = $user->bookCarts;
        }
        return view('cart.dropdowncart', compact('carts'));
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
        $book = Book::find($request->book_id);
        $this->validate($request, [
            'quantity' => 'numeric|required|min:1|max:' .$book->quantity
        ]);
//        return $request->all();
        $last = Cart::orderBy('id', 'desc')->first();
        if($last === null) $last = 1;
        else $last = $last->id + 1;
        $cartCode = $last < 10 ? "CA000000".$last : ($last < 100 ? "CA00000".$last :
            ($last < 1000 ? "CA0000".$last:($last < 100000 ? "CA000".$last:
                ($last < 1000000 ? "CA00".$last :($last < 10000000 ? "CA0".$last : "CA".$last)))));
        $cart = new Cart();
        $data = [
            'book_id' => $request->book_id,
            'user_id' => $request->user_id,
            'quantity' => $request->quantity,
            'cart_code' => $cartCode
        ];
        $cart->create($data);
        return redirect()->route('cart.dropdowncart');
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
    public function update(Request $request)
    {
        $cart = Cart::where('book_id', '=', $request->book_id)
            ->where('user_id', '=', $request->user_id)->where('was_paid', '=', '0')->first();
        if($cart == null) {
            return $this->store($request);
        }
        $book = Book::find($request->book_id);
        $this->validate($request, [
            'quantity' => 'numeric|required|min:1|max:' .($book->quantity)
        ]);
//        $cart = User::find($request->user_id)->bookCarts()->find($request->book_id)->pivot;
//        if($cart != null) {
//            $this->update($request, 1);
//        }
        $cart->quantity = $request->quantity;
        $cart->was_paid = $request->has('was_paid') ? $request->was_paid : 0;
        $cart->save();
//        return $cart->quantity;
        return redirect()->route('cart.dropdowncart');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Cart::destroy($request->id);
        return redirect()->route('cart.dropdowncart');
    }
}
