<?php

namespace App\Http\Controllers;

use App\Bill;
use App\Book;
use App\Book_user;
use App\Category;
use App\Order;
use App\Order_item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function addSession(Request $request) {
        $request->session()->put('sort', $request
            ->has('sort') ? $request->get('sort') : ($request->session()
            ->has('sort') ? $request->session()->get('sort') : 'asc'));
        $request->session()->put('field', $request
            ->has('field') ? $request->get('field') : ($request->session()
            ->has('field') ? $request->session()->get('field') : 'updated_at'));
        $request->session()->put('search', $request
            ->has('search') ? $request->get('search') : ($request->session()
            ->has('search') ? $request->session()->get('search') : ''));
        $request->session()->put('searchCate', $request
            ->has('searchCate') ? $request->get('searchCate') : ($request->session()
            ->has('searchCate') ? $request->session()->get('searchCate') : ''));
    }

    public function index(Request $request) {
        $this->addSession($request);
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
//        $sort = session()->get('sort');
//
//        $field = session()->get('field');
//
//        $search = session()->get('search');

        $categories = Category::orderBy('name')->get();
//        $books = Book::with("users")->orderBy($field, $sort)->paginate(20);
        return view('product', compact('user', 'categories', 'state', 'carts'));
    }

    public function showsearch(Request $request) {

        $this->addSession($request);
        $sort = session()->get('sort');

        $field = session()->get('field');

        $search = session()->get('search');

        $searchCate =  session()->get('searchCate');
//        return $searchCate;
        if($request->has('notSearch') == true){
            if($request->get('notSearch') === "true") {
                $search = null;
                $searchCate = "";
                session()->forget('searchCate');
            }
        }
//        return $request->get('notSearch');
//        return session()->get('searchCate');
//        return $searchCate === "" ? "true" : "false";
        if($searchCate !== "") {
            $books = Book::whereIn('books.id',
                        DB::table('book_category')->select('book_id', DB::raw("count(*) as total"))
                            ->whereIn('book_category.category_id', $searchCate)
                            ->groupBy('book_id')
                            ->having('total', '>=', count($searchCate))->pluck('book_id')
                )->orderBy($field, $sort)->paginate(20);
        }
        else{
            if ($search !== null)$books = Book::with("users")->where('books.name', 'like', '%'.$search.'%')->orderBy($field, $sort)->paginate(20);
            else $books = Book::with("users")->orderBy($field, $sort)->paginate(20);
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
        $carouselBooks  = Book::with("users")->whereIn('book_code',
            DB::table('order_items')->select('order_items.book_code', DB::raw('count(*) as total'))
                ->whereIn( 'book_code', Book::whereHas('categories', function ($query) use ($book) {
                                $query->whereIn('categories.id', $book->categories->pluck('id'));
                            })->pluck('book_code') )
                ->groupBy('book_code')
                ->orderBy('total', 'desc')->limit(18)->pluck('book_code')
        )->get();
//        return $recommendBooks;
        $carousel_name = "Sách Cùng Thể Loại";
        return view('show', compact('book', 'carouselBooks', 'user', 'carts', 'was_paid', 'carousel_name'));
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
        $was_paid = count($orders) < 1 ? 0 : 1;
//        return count($orders);
        return view('comment', compact('book', 'user', 'comments', 'was_paid', 'cmt'));
    }

    public function showDescription($id) {
        $book = Book::findOrFail($id);
        return view('bookdescription',compact('book'));
    }
}
