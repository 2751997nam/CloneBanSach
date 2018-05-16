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
//    $books = \App\Book::with("users")->get();
    $carouselBooks = \App\Book::with("users")->whereIn('book_code',
            DB::table('order_items')->select('order_items.book_code', \Illuminate\Support\Facades\DB::raw('count(*) as total'))
                ->groupBy('book_code')
                ->orderBy('total', 'desc')->limit(18)->pluck('book_code')
        )->get();
//    return $popularBooks;
    $recommendBooks = \App\Book::with("users")->whereIn('book_code',
        DB::table('order_items')->select('order_items.book_code', \Illuminate\Support\Facades\DB::raw('count(*) as total'))
            ->whereDate('created_at', '>=' , \Carbon\Carbon::now()->subDay(30))
            ->groupBy('book_code')
            ->orderBy('total', 'desc')->limit(18)->pluck('book_code')
        )->get();
//    return $recommendBooks;
//    $books = $popularBooks;
    $carousel_name = "Sách Bán Chạy";
    return view('welcome', compact('carouselBooks', 'recommendBooks', 'user', 'carts', 'carousel_name'));
})->name('index');

Route::resource('/book', 'BookController')->middleware(['auth', 'level']);

Route::resource('/categories', 'CategoriesController')->middleware(['auth', 'level']);

Route::resource('/employees', 'EmployeesController')->middleware(['auth', 'level']);

Route::group(['prefix' => '/pdf', 'as' => 'pdf.', 'middleware' => ['auth', 'level']], function () {
    Route::get('/employees', 'PdfController@employees')->name('employees');
    Route::get('/bill/{bill_code}', 'PdfController@bill')->name('bill');
});

Route::resource('/positions', 'PositionsController')->middleware( ['auth', 'level']);

Route::resource('/users', 'UserController')->middleware( ['auth', 'level']);

Route::group(['prefix' => '/book_user', 'as' => 'book_user.', 'middleware' => ['auth', 'level']], function () {
    Route::post('/', 'Book_userController@store')->name('store');
    Route::put('/', 'Book_userController@update')->name('update');
    Route::delete('/', 'Book_userController@destroy')->name('destroy');
});

Route::group(['prefix' => 'product', 'as' => 'product.'], function (){

    Route::get('/', 'ProductController@index')->name('index');

    Route::get('/show-search/', 'ProductController@showsearch')->name('search');

    Route::get('/show/{id}', 'ProductController@show')->name('show');
    Route::get('/comment/{id}/', 'ProductController@showComment')->name('comment');
    Route::get('/description/{id}/', 'ProductController@showDescription')->name('description');
});

Route::group(['prefix' => 'cart', 'as' => 'cart.', 'middleware' => ['auth']], function () {
    Route::get('/', 'CartController@index')->name('index');
    Route::get('/dropdowncart', 'CartController@dropdowncart')->name('dropdowncart');
    Route::put('/update', 'CartController@update')->name('update');
    Route::delete('/', 'CartController@destroy')->name('destroy');
});
Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => ['auth', 'level']], function() {
    Route::get('/account', 'UserController@account')->name('account');
    Route::get('/profile', 'UserController@profile')->name('profile');
    Route::get('/order', 'UserController@order')->name('order');
    Route::get('/showOrder', 'OrderController@showUserOrder')->name('showOrder');
    Route::get('/changepassword', 'UserController@changePassword')->name('changePassword');
    Route::put('/storepassword', 'UserController@storePassword')->name('storePassword');
    Route::get('/showOptionOrder/{status}', 'OrderController@showOptionOrder')->name('showOptionOrder');
});
//Route::resource('/order', 'OrderController')->middleware('auth');
Route::group(['prefix' => 'order', 'as' => 'order.', 'middleware' => ['auth', 'level']], function () {
    Route::get('/', 'OrderController@index')->name('index');
    Route::get('/create', 'OrderController@create')->name('create');
    Route::post('/store', 'OrderController@store')->name('store');
    Route::delete('/destroy', 'OrderController@destroy')->name('destroy');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'level']], function () {
    Route::get('/', 'AdminController@index')->name('index');
});

Route::resource('/bills', 'BillController')->middleware(['auth', 'level']);

Route::group(['prefix' => 'verify', 'as' => 'verify.'], function () {
    Route::get('/{email}/{verifyToken}', 'Auth\RegisterController@verifyEmailDone')->name('verifyEmailDone');
    Route::get('/resendVerify', 'Auth\LoginController@resendVerifyView')->name('resendVerifyView');
    Route::post('/resendVerifyEmail', 'Auth\LoginController@resendVerifyEmail')->name('resendVerifyEmail');
});
Route::get('/registered', 'Auth\RegisterController@registered')->name('registerd');
Auth::routes();