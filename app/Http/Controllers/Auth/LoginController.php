<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Agent;
use App\House;

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
    protected $redirectTo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        if (Auth::check() && Auth::user()->role->id == 1 ) {
            $this->redirectTo = route('admin.dashboard');
        }elseif(Auth::check() && Auth::user()->role->id == 2){
                $this->redirectTo = route('landlord.dashboard');
        }elseif(Auth::check() && Auth::user()->role->id == 5){
        $this->redirectTo = route('dalali.dashboard');}
        else{
                $this->redirectTo = route('welcome');
        }
        $this->middleware('guest')->except('logout');
    }

    public function showLogin()
    {
        if(!session()->has('url.intended'))
    {
        session(['url.intended' => url()->previous()]);
    }
    $paidHousesCount = 0;
    $wishlistCount = 0;
        return view('auth.loginrenter', compact('paidHousesCount', 'wishlistCount'));
    }

    public function showLandLordLogin()
    {
        if(!session()->has('url.intended'))
    {
        session(['url.intended' => url()->previous()]);
    }
    $paidHousesCount = 0;
    $wishlistCount = 0;
        return view('auth.loginlandlord', compact('paidHousesCount', 'wishlistCount'));
    }

    public function showAgentLogin()
    {
        if(!session()->has('url.intended'))
    {
        session(['url.intended' => url()->previous()]);
    }
    $paidHousesCount = 0;
    $wishlistCount = 0;
        return view('auth.loginagent', compact('paidHousesCount', 'wishlistCount'));
    }

    public function showLoginRegister()
    {
        if(!session()->has('url.intended'))
    {
        session(['url.intended' => url()->previous()]);
    }
    $paidHousesCount = 0;
    $wishlistCount = 0;
        return view('auth.loginregister', compact('paidHousesCount', 'wishlistCount'));
    }

}
