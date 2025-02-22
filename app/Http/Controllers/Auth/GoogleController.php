<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Socialite;
use Illuminate\Support\Facades\Hash;

class GoogleController extends Controller
{

    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function redirectToGoogle()
    {

        return Socialite::driver('google')->stateless()->redirect();
    }

    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function handleGoogleCallback()
    {

        try {

            $user = Socialite::driver('google')->stateless()->user();

            $finduser = User::where('google_id', $user->id)->first();

            if ($finduser) {

                Auth::login($finduser);

                return redirect('/home');
            } else {

                $newUser = User::create([

                    'name' => $user->name,

                    'email' => $user->email,

                    'google_id' => $user->id,

                    'password' => bcrypt('112233'),

                    'role_id' => 3,
                    
                    'contact' => uniqid(),

                ]);

                Auth::login($newUser);

                return redirect('/home');
            }
        } catch (Exception $e) {

            dd($e->getMessage());
        }
    }
}
