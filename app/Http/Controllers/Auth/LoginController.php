<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        if(\Request::route()->getName() == 'admin.login' || \Request::route()->getName() == 'admin')
        {
            return view('auth.admin.login'); 
        } else {
            return view('auth.login'); 
        }
    }

    protected function redirectTo()
    {
        if(Auth::User()->status==1)
        {
            if (request()->session()->get('BOOKNOW')) {
                return RouteServiceProvider::BOOKING;
            }
            if (auth()->user()->role == 3) {
                return RouteServiceProvider::DASHBOARD;
            }
            if (auth()->user()->role == 2) {
                return RouteServiceProvider::MAID_DASHBOARD;
            }
            return RouteServiceProvider::HOME;
        } else {
            if (auth()->user()->role == 3 || auth()->user()->role == 2) {
                \Auth::logout();
                session()->flash('error', 'Your account is not active');
                return RouteServiceProvider::ADMIN;
            } else if (auth()->user()->role == 1) {
                \Auth::logout();
                session()->flash('error', 'Your account is not active');
                return RouteServiceProvider::LOGIN;
            }

        }
    }

}
