<?php

namespace App\Http\Controllers\Auth;

use PhpParser\Node\Expr\FuncCall;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    //protected $redirectTo = RouteServiceProvider::HOME;
    protected function redirectTo()
    {
        if(Auth::user()->usertype == 'admin')
        {
            return 'admin-dashboard';
        }
        else if (Auth::user()->usertype == 'winghead')
        {
            return 'winghead-dashboard';
        }
        else if (Auth::user()->usertype == 'developer')
        {
            return 'developer-dashboard';
        }
        else if (Auth::user()->usertype == 'client')
        {
            return 'client';
        }
        else
        {
            return 'home';
        }
    }
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
