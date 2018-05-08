<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $user = null;
    $carts = null;
    if(Auth::check()) {
        $user = Auth::user();
        $carts = $user->bookCarts;
    }
    $books = \App\Book::with("users")->get();
    return view('welcome', compact('books', 'user', 'carts'));
})->name('index');

Route::resource('/book', 'BookController')->middleware('auth');

Route::resource('/categories', 'CategoriesController')->middleware('auth');

Route::resource('/employees', 'EmployeesController')->middleware('auth');

Route::resource('/positions', 'PositionsController')->middleware( 'auth');

Route::resource('/users', 'UserController')->middleware( 'auth');

Route::group(['prefix' => '/book_user', 'as' => 'book_user.'], function () {
    Route::post('/', 'Book_userController@store')->name('store');
    Route::put('/', 'Book_userController@update')->name('update');
    Route::delete('/', 'Book_userController@destroy')->name('destroy');
});

Route::group(['prefix' => 'product', 'as' => 'product.'], function (){

    Route::get('/', 'ProductController@index')->name('index');

    Route::get('/show-search/', 'ProductController@showsearch')->name('search');

    Route::get('/show/{id}', 'ProductController@show')->name('show');
    Route::get('/comment/{id}/', 'ProductController@showComment')->name('commnet');
    Route::get('/description/{id}/', 'ProductController@showDescription')->name('description');
});

Route::group(['prefix' => 'cart', 'as' => 'cart.', 'middleware' => 'auth'], function () {
    Route::get('/', 'CartController@index')->name('index');
    Route::get('/dropdowncart', 'CartController@dropdowncart')->name('dropdowncart');
    Route::put('/update', 'CartController@update')->name('update');
    Route::delete('/', 'CartController@destroy')->name('destroy');
});
Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => 'auth'], function() {
    Route::get('/account', 'UserController@account')->name('account');
    Route::get('/profile', 'UserController@profile')->name('profile');
    Route::get('/order', 'UserController@order')->name('order');
    Route::get('/showOrder', 'OrderController@showUserOrder')->name('showOrder');
    Route::get('/changepassword', 'UserController@changePassword')->name('changePassword');
    Route::put('/storepassword', 'UserController@storePassword')->name('storePassword');
    Route::get('/showOptionOrder/{status}', 'OrderController@showOptionOrder')->name('showOptionOrder');
});
//Route::resource('/order', 'OrderController')->middleware('auth');
Route::group(['prefix' => 'order', 'as' => 'order.', 'middleware' => 'auth'], function () {
    Route::get('', 'OrderController@index')->name('index');
    Route::get('/create', 'OrderController@create')->name('create');
    Route::post('/store', 'OrderController@store')->name('store');
    Route::delete('/destroy', 'OrderController@destroy')->name('destroy');
});

Route::resource('/bills', 'BillController')->middleware('auth');
Auth::routes();