<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator,Redirect,Response,File;
use Socialite;
use App\User;
        
class SocialController extends Controller
        {
    public function redirect($provider)
{
     return Socialite::driver($provider)->redirect();
 }

 public function callback($provider)
 {
   $getInfo = Socialite::driver($provider)->user(); 
   $user = $this->createUser($getInfo,$provider); 
   auth()->login($user); 
   return redirect()->to('/home');
 }
 
 function createUser($getInfo,$provider){
 
    $user = User::where('provider_id', $getInfo->id)->first();
            if (!$user) {
                $user = User::create([
                'name'     => $getInfo->name,
                'email'    => $getInfo->email,
                'provider' => $provider,
                'password' => bcrypt('112233'),
                'role_id'  => 3,
                'contact'  => uniqid(),
                'provider_id' => $getInfo->id
     ]);
   }
   return $user;
    }
}