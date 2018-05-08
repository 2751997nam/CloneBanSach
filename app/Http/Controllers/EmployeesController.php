<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Position;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Mockery\Exception;

class EmployeesController extends Controller
{

    public function addSession(Request $request) {
        //        session()->flush();
        $check = ['id', 'employee_code', 'fullname', 'dob', 'email', 'salary_level', 'position', 'created_at', 'updated_at'];
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
//        return session()->all();
        $employees = DB::table('users')->join('employees', 'users.id', '=', 'employees.id')
            ->join('positions', 'employees.position_id', '=', 'positions.id')
            ->select('users.id', 'users.name as fullname',
                'users.email','employees.employee_code', 'employees.salary_level', 'dob', 'positions.name as position', 'users.updated_at', 'users.created_at')
            ->where('users.name', 'like', '%'.$request->session()->get('search').'%')
            ->orderBy($request->session()->get('field'), $request->session()->get('sort'))->paginate(5);
        $page = $employees->currentPage();
        if($request->ajax()) {
            return view('employees.index', compact('employees', 'page'));
        }else {
            return view('employees.ajax', compact('employees', 'page'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employees.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function validateEmployees(Request $request, $id = null) {
        $sl = Position::find($request->input('position'))->base_salary_level;
        $rules = [
            'fullname' => 'required|min:7|max:100',
            'email' => ['required', 'email',
                Rule::unique('users')->ignore($id)
            ],
            'salary_level' => 'numeric|min:'.$sl
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            return $validator;
        }else return "success";
    }

    public function createUser(Request $request, User $user) {
        $user->email = $request->email;
        $user->name = $request->fullname;
        $d = implode('', explode('-', $request->dob));
        $user->password = Hash::make($d);
        $user->is_customer = 0;
        try{
            $user->save();
        }catch (Exception $e) {
            return "fail";
        }
        return $user->id;
    }

    public function createEmployee(Request $request, User $user) {
        $employee = new Employee();
        if($user !== null) {
            $employee = Employee::findOrFail($user->id);
        }
        $id = $this->createUser($request, $user);
        if($id === "fail") return;

        $employee->id = $id;

        $b = Employee::orderBy('id', 'desc')->first();
        $count = 1;
        if($b !== null) $count = $b->id + 1;
        if($employee->employee_code === null)
            $employee->employee_code = $count < 10 ? "E"."000".$count:($count < 100 ? "E"."00".$count:($count < 1000?"E"."0".$count:"E".$count));
        $employee->dob = $request->dob;
        $request->has('salary_level') ? $employee->salary_level = $request->salary_level : $employee->salary_level = Position::find($request->input('position'))->base_salary_level;
        $employee->position_id = $request->position;
        $employee->level = 1;

        try{
            $employee->save();
        }catch (Exception $e) {
            User::destroy($id);
            return $e;
        }

    }
    public function form(Request $request, User $user) {
        $this->createEmployee($request, $user);
    }
    public function store(Request $request)
    {
        $validator = $this->validateEmployees($request);
        if($validator !== "success") {
            return response()->json([
                'fail' =>true,
                'errors' => $validator->errors()
            ]);
        }
        $user = new User();
        $this->form($request, $user);
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
        return view('employees.form', compact('id'));
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
        $validator = $this->validateEmployees($request, $id);
        if($validator !== "success") {
            return response()->json([
                'fail' =>true,
                'errors' => $validator->errors()
            ]);
        }
        $user = User::findOrFail($id);
        $this->form($request, $user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Employee::destroy($id);
        User::destroy($id);
        return redirect()->route('employees.index');
    }
}
