<?php

namespace App\Http\Controllers;

use App\Book;
use App\Charts\Charts;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index() {
//        $books = DB::table('order_items')->select('book_code', DB::raw("count(*) as total"))
//            ->whereDate('created_at', '>=' , Carbon::now()->subDay(30))
//            ->groupBy('book_code')
//            ->orderBy('total', 'desc')
//            ->limit(10);
//        $total = $books->pluck('total');
//        $label = $books->pluck('book_code');
////        return $books;
//        $chart = new Charts();
//        $chart->dataset('Book', 'doughnut', $total);
//         $chart->labels($label);
        return view('admin/index');
    }
}
