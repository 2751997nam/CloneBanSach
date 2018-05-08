<?php

namespace App\Http\Controllers;

use App\User;
use App\User_information;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function order() {
        session()->flash('page', '/user/showOrder');
        $user = Auth::user();
        return view('user.account', compact('user'));
    }
    public function account() {
        if(session()->has('page')) {
            if(strcmp(session()->get('page'), "/user/changepassword") !== 0 ) {
                session()->forget('oldPassword');
                session()->forget('newPassword');
                session()->forget('comfirmPassword');
            }
        }
        else {
            session()->flash('page', '/user/profile');
            session()->forget('oldPassword');
            session()->forget('newPassword');
            session()->forget('comfirmPassword');
        }
        $user = Auth::user();
        return view('user.account', compact('user'));
    }

    public function profile() {
        $user = Auth::user();
        $information = $user->information;
        if($information === null) $information = new User_information();
        return view('user.profile', compact('user', 'information'));
    }

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
            'name' => 'required|min:5|max:100',
            'email' => 'required|email|max:256|unique:users',
            'passwords' => 'required|min:6|max:32',
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
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
    public function update(Request $request, $id)
    {
//        return $request->all();
        $this->validate($request, [
            'name' => 'required|min:5|max:100',
            'email' => ['required', 'email',
                Rule::unique('users')->ignore($id)
            ],
            'phone' => 'min:10|max:15|phone',
            'dob' => 'date'
        ]);
//        return $request->all();
        try {
            $user = User::find($id);
            $info = User_information::where('user_id', '=', $id)->first();
            if ($request->has('name')) $user->name = $request->name;
            if ($request->has('email')) $user->email = $request->email;
            if ($request->has('passwords')) $user->password = Hash::make($request->password);
            if ($info === null) {
                $info = new User_information();
            }
            if ($request->has('phone')) $info->phone = $request->phone;
            if ($request->has('dob')) $info->dob = $request->dob;
            if ($request->has('gender')) $info->gender = $request->gender;
            $info->user_id = $id;
            $user->save();
            $info->save();
            DB::commit();
            session()->flash('message', "Thành Công!");
        }catch (\Exception $e) {
            DB::rollback();
            session()->flash('message', "Lỗi!");
        }
        return redirect()->route('user.account');
    }

    public function changePassword() {
        session()->flash('page', '/user/changepassword');
        $user = Auth::user();
        return view('user.changepassword', compact('user'));
    }

    public function storePassword(Request $request) {
        session()->forget('oldPassword');
        session()->forget('newPassword');
        session()->forget('comfirmPassword');
        $user = User::find($request->id);
        $old = $request->get('oldPassword');
        $new = $request->get('newPassword');
        $comfirm = $request->get('comfirmPassword');
        session()->flash('page', '/user/changepassword');
        if (strlen($old) < 6 || strlen($old) > 32) {
            session()->put('oldPassword', 'Mật khẩu ít nhất 6 ký tự, tối đa 32 ký tự');
            return redirect()->back();
        }
        if (strlen($new) < 6 || strlen($new) > 32) {
            session()->put('newPassword', 'Mật khẩu ít nhất 6 ký tự, tối đa 32 ký tự');
            return redirect()->back();
        }
        if (strlen($comfirm) < 6 || strlen($comfirm) > 32) {
            session()->put('comfirmPassword', 'Mật khẩu ít nhất 6 ký tự, tối đa 32 ký tự');
            return redirect()->back();
        }
        if(!Auth::attempt(['email' => $user->email, 'passwords' => $old])) {
            session()->put('oldPassword', 'Mật khẩu cũ không đúng');
            return redirect()->back();
        }
        if(strcmp($old, $new) == 0) {
            session()->put('oldPassword', 'Mật khẩu mới không thể giống mật khẩu cũ');
            return redirect()->back();
        }
        if(strcmp($new, $comfirm) != 0) {
            session()->put('newPassword', 'Nhập mật khẩu mới giống nhau');
            session()->put('comfirmPassword', 'Nhập mật khẩu mới giống nhau');
            return redirect()->back();
        }
        try {
            $user->password = Hash::make($new);
            $user->save();
            DB::commit();
        }catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
        session()->flash('message', 'Đổi mật khẩu thành công');
        session()->flash('page', '/user/profile');
        return redirect()->route('user.account');
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
