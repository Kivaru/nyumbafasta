<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SocialAuthTwitterController extends Controller
{
    /**
   * Create a redirect method to twitter api.
   *
   * @return void
   */
  public function redirect()
  {
      return Socialite::driver('twitter')->redirect();
  }

  /**
   * Return a callback method from twitter api.
   *
   * @return callback URL from twitter
   */
  public function callback()
  {
    try {

      $user = Socialite::driver('twitter')->stateless()->user();

      $finduser = User::where('provider', $user->provider)->first();

      if ($finduser) {

          Auth::login($finduser);

          return redirect('/home');
      } else {

          $newUser = User::create([

              'name' => $user->name,

              'email' => $user->email,

              'provider' => $user->provider,

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
