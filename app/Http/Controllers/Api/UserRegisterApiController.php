<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use Gate;
use DB;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use App\Tokens;
use App\User;


class UserRegisterApiController extends Controller

{
    public function index(Request $request)
    {

        $token = Str::random(120);

        $user = DB::table('users')->where('contact', $request->phonenumber)
                                  ->first();

        //check if user exist
        if($user === null){
        $newUser = new User();
        $newUser->role_id = $request->role_id;
        $newUser->name = $request->name .' '.$request->lname;
        $newUser->contact  = $request->phonenumber;
        $newUser->email = $request->email;
        $newUser->password = Hash::make($request->password);
        $newUser->save();

        if($newUser){
            DB::table('oauth_access_tokens')->insert(
                array(
                       'user_id'     =>   $newUser->id,
                       'client_id'   =>   $request->header('User-Agent'),
                       'name'        =>   $token
                )
           );
        }

       return response()->json(['user_id'=>$newUser->id,'token'=>$token, 'status'=>'200']);

    }

        else{

            return response()->json(['message'=>'You are Already Registered User', 'status'=>'400']);
        }
    }

}
