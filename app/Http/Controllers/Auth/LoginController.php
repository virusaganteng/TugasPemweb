<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use Redirect;
use DB;
use Auth;

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

    public function login(Request $req)
    {
        //dd($req->all());
        //return $check = User::where('email',$req->email)->get();
        $email = User::where(DB::raw('email'),$req->email)->first();
        //$email = DB::table('users')->where(DB::raw('email'),$req->email)->first();

        if ($email && $email->password == md5($req->password)) {
            Auth::login($email);
            return redirect(url('/home'));
        }else{

            return Redirect::back()->withErrors(['Wrong Username / Password !']);
        }
    }

    // use AuthenticatesUsers;

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('/');
    }

    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
