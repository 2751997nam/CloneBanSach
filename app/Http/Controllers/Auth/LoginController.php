<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VerifyEmail;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Mail;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $remember = $request->has('rememberMe') ? true : false;
        if(Auth::attempt(['email' => $email, 'password' => $password], $remember)) {
            $user = Auth::user();
            if(!$user->verified()) {
                Auth::logout();
                return redirect()->route('login')->withErrors(['verified' =>  'Hãy xác nhận email của bạn']);
            }
            if($user->is_customer === 1)
                return redirect($this->redirectTo);
            else return redirect()->route('admin.index');
        }
        else {
            redirect()->route('login');
        }
        return $this->sendFailedLoginResponse($request);
    }

    public function resendVerifyView() {
        return view('email.resendVerifyView');
    }

    public function resendVerifyEmail(Request $request) {
        $this->validate($request, [
            'email' => 'required|email'
        ]);
        $user = User::where(['email' => $request->email])->first();
        if(!$user) {
            return Redirect::back()->withErrors(['email' => 'Email không tồn tại']);
        }
        Mail::to($user['email'])->send(new VerifyEmail($user));
        return Redirect::back()->with('message', 'Gửi email xác nhận thành công!');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('/');
    }
}
