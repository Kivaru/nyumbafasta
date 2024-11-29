<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use Gate;
use DB;
use App\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use App\Tokens;


class UserLoginApiController extends Controller

{
    public function index(Request $request)
    {

        $token = Str::random(120);

        $user = DB::table('users')->where('contact', $request->phonenumber)
                                  ->first();

        if(Hash::check($request->password, $user->password)){

        $tokens = new Tokens();
        $tokens->user_id = $user->id;
        $tokens->client_id = $request->header('User-Agent');
        $tokens->name = $token;
        $tokens->save();

       return response()->json(['user_id'=>$user->id, 'user_role'=>$user->role_id,'token'=>$token, 'status'=>'200']);

    }

        else{

            return response()->json(['error'=>'Unauthorised', 'status'=>'401']);
        }
    }


    public function getUserProfile($id){

        $user = User::where('id', $id)->first();

        if($user){
            return response()->json($user);
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }

    }

    public function updateUserProfile(Request $request){

        $user = User::where('contact', $request->phonenumber)->first();

        return $request;

        if($user){

            $user->name = $request->fullname;
            $user->phonenumber = $request->phonenumber;
            $user->email = $request->email;

            if($request->password){
                $user->password =  Hash::make($request->password);
            }

            $user->save();

            return response()->json($user);
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }

    }

}
