<?php

namespace App\Http\Controllers;

use App\Bill;
use App\Book;
use App\Book_user;
use App\Order;
use App\Order_item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Request $request) {
        $state = null;
        if ($request->has('search')) {
            session()->put('search' , $request->get('search'));
            $state = $request->get('state');
        }
        $user = null;
        $carts = null;
        if(Auth::check()) {
            $user = Auth::user();
            $carts = $user->bookCarts;

        }
        $categories = \App\Category::all();
        return view('product', compact('user', 'categories', 'state', 'carts'));
    }

    public function showsearch(Request $request) {
        $request->session()->put('sort', $request
            ->has('sort') ? $request->get('sort') : ($request->session()
            ->has('sort') ? $request->session()->get('sort') : 'asc'));

        $sort = session()->get('sort');

        $request->session()->put('field', $request
            ->has('field') ? $request->get('field') : ($request->session()
            ->has('field') ? $request->session()->get('field') : 'updated_at'));
        $field = session()->get('field');

        $request->session()->put('search', $request
            ->has('search') ? $request->get('search') : ($request->session()
            ->has('search') ? $request->session()->get('search') : ''));
        $search = session()->get('search');

        if($request->has('notSearch') == true){
            if($request->get('notSearch') === "true") {
                $search = null;
            }
        }
        if(is_array($search)) {
            $books = \App\Book::whereHas('categories', function ($query) use ($search) {
                $query->whereIn('categories.id', $search);
            })->orderBy($field, $sort)->paginate(3);
        }
        else{
            if ($search !== null)$books = \App\Book::with("users")->where('books.name', 'like', '%'.$search.'%')->orderBy($field, $sort)->paginate(3);
            else $books = \App\Book::with("users")->orderBy($field, $sort)->paginate(3);
        }
        return view('showsearch', compact('books'));
    }

    public function show($id) {
        $book = Book::findOrFail($id);
        $user = null;
        $carts = null;
        if(Auth::check()) {
            $user = Auth::user();
            $carts = $user->bookCarts;
        }
//        return $book->categories;
        return view('show', compact('book', 'user', 'carts', 'was_paid'));
    }

    public function showComment($id) {
        $book = Book::findOrFail($id);
        $user = null;
        $orders = null;
        $cmt = new Book_user();
        if(Auth::check()) {
            $user = Auth::user();
            $orders = Order::where('user_id', '=', $user->id)
                ->whereIn('id', Bill::where('was_paid', '=', 1)->pluck('order_id'))
                ->whereIn('id', Order_item::where('book_code', '=', $book->book_code)->pluck('order_id'))->get();
            $cmt = Book_user::where('user_id', '=', $user->id)->where('book_id', '=', $id)->first();
            $cmt === null ? $cmt = new Book_user() : "";
        }
        $comments = $book->users()->where('book_id', '=', $id)->where('star', '!=', null)->orderBy('created_at')->paginate(3);
        $was_paid = $orders->isEmpty() ? 0 : 1;
        return view('comment', compact('book', 'user', 'comments', 'was_paid', 'cmt'));
    }

    public function showDescription($id) {
        $book = Book::findOrFail($id);
        return view('bookdescription',compact('book'));
    }
}
