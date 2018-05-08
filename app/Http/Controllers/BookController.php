<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;

class BookController extends Controller
{
    public function addSession(Request $request) {
        //        session()->flush();
        $check = ['id', 'book_code', 'name', 'price', 'author', 'publisher', 'quantity', 'discount', 'created_at', 'updated_at'];
        if(session()->has('field') && in_array(session()->get('field'), $check)) session()->forget('field');
        if(session()->has('search') && in_array(session()->get('search'), $check)) session()->forget('search');

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
        $books = new Book();
        $books = $books->where('name', 'like', '%'.$request->session()->get('search').'%')
        ->orderBy($request->session()->get('field'), $request->session()->get('sort'))->paginate(5);

        $page = $books->currentPage();
        if($request->ajax()) {
            return view('book.index', compact('books', 'page'));
        }else {
            return view('book.ajax', compact('books', 'page'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('book.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function form(Request $request, Book $book) {
        $b = Book::orderBy('id', 'desc')->first();
        $count = 1;
        if($b !== null)$count = $b->id + 1;
        if($book->book_code === null)
            $book->book_code = $count < 10 ? "B"."000".$count:($count < 100 ? "B"."00".$count:($count < 1000?"B"."0".$count:"B".$count));
        $book->name = $request->name;

        if($request->has('img')){
            if($book->img !== null) {
                Storage::delete($book->img);
            }
            $file = $request->file('img');
            $fileName = $file->getClientOriginalName();
            $filePath = config('filesystems.img_path');
            if(file_exists($file)){
                $fileName = md5(str_random(15)).$fileName;
            }
            $path = $file->storeAs($filePath, $fileName);
            $book->img = $path;
            $book->img_name = $fileName;
        }

        $book->author = $request->author;
        $book->description = $request->description;
        $book->publisher = $request->publisher;
        $book->price = $request->price;
        $book->discount = $request->discount;
        $book->quantity = $request->quantity;
        $book->save();

        $categories = implode(',', $request->input('categories'));
        $categories = explode(',', $categories);
        $id = $book->id;
        $book->Categories()->sync($categories);

//        return response()->json([
//            'fail' => false,
//            'redirect_url' => url('book')
//        ]);
    }

    public function validateBook(Request $request) {
        $rules = [
            'name' => 'required|max:100|min:5',
            'img' => 'image|max:5120',
            'categories' => 'required',
            'author' => 'required|max:100|min:5',
            'description' => 'required|max:5000',
            'price' => 'required|numeric|min:0',
            'discount' => 'required|numeric|min:0|max:100',
            'quantity' => 'required|numeric|min:0'
        ];
        $this->validate($request, $rules);
//        $validator = Validator::make($request->all(), $rules);
//        if ($validator->fails()){
//            return $validator;
//        }else return "success";
    }

    public function store(Request $request)
    {
        $validator = $this->validateBook($request);
//        if($validator !== "success") {
//            return response()->json([
//                'fail' =>true,
//                'errors' => $validator->errors()
//            ]);
//        }
        $book = new Book();
        $this->form($request, $book);
        return redirect()->route('book.index');
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
        return view('book.form', compact('id'));
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
        $validator = $this->validateBook($request);
//        if($validator !== "success") {
//            return response()->json([
//                'fail' =>true,
//                'errors' => $validator->errors()
//            ]);
//        }
        $book = Book::findOrFail($id);
        $this->form($request, $book);
        return redirect()->route('book.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $img = Book::findOrFail($id);
        Storage::delete($img->img);
        Book::destroy($id);
        return redirect('book');
    }
}
