<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\User;
use Mail;
use Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    /**
       * Write code on Method
       *
       * @return response()
       */
      public function showForgetPasswordForm()
      {

        $userID = Auth::id();

        $paidHousesCount = 0;

        if($userID){

            $paidHouses = DB::table('houses')
                        ->join('selcom_payments', 'houses.id', '=', 'selcom_payments.house_id')
                        ->where('selcom_payments.payment_status', "COMPLETED")
                        ->where('houses.user_id', $userID)
                        ->get();
         $paidHousesCount = count($paidHouses);


        }

         return view('auth.forgetPassword',  compact('paidHousesCount'));
      }

      /**
       * Write code on Method
       *
       * @return response()
       */
      public function submitForgetPasswordForm(Request $request)
      {

        $request->validate([
            'contact' => 'required|exists:users',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);


        User::where('contact', $request->contact)->update([
            'password' => Hash::make($request->password),
            'updated_at' => Carbon::now(),
        ]);

        //   $request->validate([
        //       'email' => 'required|email|exists:users',
        //   ]);

        //   $token = Str::random(64);

        //   DB::table('password_resets')->insert([
        //       'email' => $request->email,
        //       'token' => $token,
        //       'created_at' => Carbon::now()
        //     ]);

        //   Mail::send('email.forgetPassword', ['token' => $token], function($message) use($request){
        //       $message->to($request->email);
        //       $message->subject('Reset Password');
        //   });

          return redirect()->route('login')->with('message', 'Password Reset Successfully! Please Login Again');
      }
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function showResetPasswordForm($token) {

        $userID = Auth::id();

        $paidHousesCount = 0;

        if($userID){

            $paidHouses = DB::table('houses')
                        ->join('selcom_payments', 'houses.id', '=', 'selcom_payments.house_id')
                        ->where('selcom_payments.payment_status', "COMPLETED")
                        ->where('houses.user_id', $userID)
                        ->get();
         $paidHousesCount = count($paidHouses);


        }

         return view('auth.forgetPasswordLink', ['token' => $token]);
      }

      /**
       * Write code on Method
       *
       * @return response()
       */
      public function submitResetPasswordForm(Request $request)
      {
          $request->validate([
              'email' => 'required|email|exists:users',
              'password' => 'required|string|min:6|confirmed',
              'password_confirmation' => 'required'
          ]);

          $updatePassword = DB::table('password_resets')
                              ->where([
                                'email' => $request->email,
                                'token' => $request->token
                              ])
                              ->first();

          if(!$updatePassword){
              return back()->withInput()->with('error', 'Invalid token!');
          }

          $user = User::where('email', $request->email)
                      ->update(['password' => Hash::make($request->password)]);

          DB::table('password_resets')->where(['email'=> $request->email])->delete();

          return redirect('/login/renter')->with('message', 'Your password has been changed!');
      }



}
