<?php

namespace App\Http\Controllers;

use App\Book;
use App\Book_user;
use App\User;
use Illuminate\Http\Request;

class Book_userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
           'comment' => 'max:1000'
        ]);
//        if(User::find($request->user_id)->books()->find($request->book_id)->pivot) {
//            return $this->update($request);
//        }
        $user = User::find($request->user_id);
        $book = Book::find($request->book_id);
        $data = [
            'star' => $request->star,
            'comment' => $request->comment,
            'isLike' => $request->isLike  === null ? 0 : $request->isLike,
        ];

        $user->books()->attach($book->id, $data);
//        $book_user = new Book_user();
//        $book_user->book_id = $request->book_id;
//        $book_user->user_id = $request->user_id;
//        $book_user->star = $request->star;
//        $book_user->comment = $request->comment;
//        $book_user->isLike = $request->isLike;
//        $book_user->save();
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
        $this->validate($request, [
            'comment' => 'max:1000'
        ]);
//        $book_user = Book_user::where('book_id', '=', $request->book_id)
//                        ->where('user_id', '=', $request->user_id)->first();
//        $book_user->book_id = $request->book_id;
//        $book_user->user_id = $request->user_id;

//        $book_user->save();
        $book_user = Book_user::where('book_id', '=', $request->book_id)->where('user_id', '=', $request->user_id)->first();
        if($book_user == null) {
            return $this->store($request);
        }
//        $book_user->star = $request->star;
//        $book_user->comment = $request->comment;
//        $book_user->isLike = $request->isLike;
        $data = [
            'star' => $request->star === null ? $book_user->star : $request->star,
            'comment' => $request->comment === null ? $book_user->comment : $request->comment,
            'isLike' => $request->isLike === null ? $book_user->isLike : $request->isLike,
        ];
//        $book_user->fill($data);
        $user = User::find($request->user_id);
        $user->books()->updateExistingPivot($request->book_id, $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
