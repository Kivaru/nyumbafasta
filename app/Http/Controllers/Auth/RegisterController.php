<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
            $this->redirectTo = route('dalali.dashboard');
        }
        else{
            $this->redirectTo = route('welcome');
        }

        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            // 'username' => ['required', 'string', 'max:255', 'unique:users'],
            //'email' => ['string', 'email', 'max:255', 'unique:users'],
            // 'nid' => ['required', 'numeric', 'unique:users'],
            'contact' => ['required', 'numeric', 'unique:users', 'digits:10'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role_id' => ['required', 'numeric'],
            'image' => 'mimes:jpeg,png,jpg',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'role_id' => $data['role_id'],
            'name' => $data['name']. ' '.$data['last_name'],
            'email' => $data['email'],
            'contact' => $data['contact'],
            'password' => Hash::make($data['password']),
            'dialed' => 0,
            'verified' => 0,
        ]);
    }

    public function register_renter(){
        $paidHousesCount = 0;
        $wishlistCount = 0;
        return view('auth.registerrenter', compact('paidHousesCount', 'wishlistCount'));
    }

    public function register_landlord(){
        $paidHousesCount = 0;
        $wishlistCount = 0;
        return view('auth.landlordregister', compact('paidHousesCount', 'wishlistCount'));
    }

    public function register_dalali(){
        $paidHousesCount = 0;
        $wishlistCount = 0;
        return view('auth.dalaliregister', compact('paidHousesCount', 'wishlistCount'));
    }


}
