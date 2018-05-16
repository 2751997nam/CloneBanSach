<?php

namespace App\Http\Controllers;

use App\Bill;
use App\Employee;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function employees() {
        $employees = Employee::with(['position', 'user'])->orderBy('employee_code', 'asc')->get();
        $base = 5000000;
        $bonus = 830000;
        $date = Carbon::now();
//        return $employees;
        $pdf = PDF::setOptions(['defaultFont' => 'Dejavu Sans'])->loadView('employees.pdf', ['employees' => $employees, 'base' => $base, 'bonus' => $bonus]);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download('salary '.$date->month.'-'.$date->year.'.pdf');
//        return view('employees/pdf', compact('employees', 'base', 'bonus'));
    }

    public function bill(Request $request) {
        $bill = Bill::where('bill_code', '=', $request->bill_code)->first();
        $pdf = PDF::setOptions(['defaultFont' => 'Dejavu Sans'])->loadView('bill.pdf',  compact('bill'));
        $date = Carbon::now();
        return $pdf->download('bill -'.' '.$bill->bill_code.'.pdf');
//        return view('bill/pdf', compact('bill'));
    }
}
