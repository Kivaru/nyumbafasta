<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use DB;
use Illuminate\Http\Request;
use Bryceandy\Selcom\Facades\Selcom;
use Illuminate\Support\Str;
use App\Jobs\UpdateSelcomPayment;

class PaymentApiController extends Controller
{
    public function checkoutPayment(Request $request)
    {

        $userToken = DB::table('oauth_access_tokens')->where('name', $request->user_token)->first();

        $user = User::where('id', $request->user_id)->first();

        $userEmail = "info@nyumbafasta.co.tz";

        if($user->email){
            $userEmail = $user->email;
        }
        else{

            $userEmail = "info@nyumbafasta.co.tz";

        }

        $data = [
            'name'           =>     $user->name,
            'email'          =>     $userEmail,
            'phone'          =>     $request->phonenumber,
            'amount'         =>     $request->amount,
            'house_id'       =>     $request->house_id,
            'user_id'        =>     $request->user_id,
            'transaction_id' =>     Str::random(10),
            'no_redirection' =>     true,
        ];

        Selcom::checkout($data);

        return response()->json(['status'=>'200']);

    }

    public function checkoutPaymentCard(Request $request)
    {


        $userToken = DB::table('oauth_access_tokens')->where('name', $request->user_token)->first();

        $user = User::where('id', $request->user_id)->first();

        $userEmail = "info@nyumbafasta.co.tz";

        if($user->email){
            $userEmail = $user->email;
        }


        $data = [
            'name'           => $user->name,
            'email'          => $userEmail,
            'phone'          => $request->phonenumber,
            'user_id'        => $request->user_id,
            'house_id'       => $request->house_id,
            'amount'         => $request->amount,
            'address'        => "Tanzania",
            'postcode'       => "255",
            'transaction_id' => Str::random(10),
        ];

        Selcom::cardCheckout($data);

        return response()->json(['status'=>'200']);

    }


    public function checkoutPaymentPlot(Request $request)
    {

        $data = [
            'name'           =>     $request->name,
            'email'          =>     "info@nyumbafasta.co.tz",
            'phone'          =>     $request->contact,
            'amount'         =>     $request->amount,
            'house_id'       =>     0,
            'user_id'        =>     0,
            'transaction_id' =>     Str::random(10),
            'no_redirection' =>     true,
        ];

        Selcom::checkout($data);

        // Fetch the orderId of the current checkout payment
        $orderId = DB::table('selcom_payments')
                        ->where('transid', $data['transaction_id'])
                        ->value('order_id');

        // Query the status from Selcom after a certain time. Use a Laravel Job or Scheduler
        // and dispatch it after 20 seconds

        UpdateSelcomPayment::dispatch($orderId)
                            ->delay(now()->addSeconds(20));

        return response()->json(['status'=>'200']);

    }

    public function checkoutPaymentCardPlot(Request $request)
    {


        $data = [
            'name'           =>     $request->name,
            'email'          =>     "info@nyumbafasta.co.tz",
            'phone'          =>     $request->contact,
            'amount'         =>     $request->amount,
            'house_id'       =>     0,
            'user_id'        =>     0,
            'transaction_id' =>     Str::random(10),
            'no_redirection' =>     true,
            'address'        =>     "Tanzania",
            'postcode'       =>     "255",
        ];

        Selcom::cardCheckout($data);

        // Fetch the orderId of the current checkout payment
        $orderId = DB::table('selcom_payments')
                        ->where('transid', $data['transaction_id'])
                        ->value('order_id');

        // Query the status from Selcom after a certain time. Use a Laravel Job or Scheduler
        // and dispatch it after 20 seconds

        UpdateSelcomPayment::dispatch($orderId)
                            ->delay(now()->addSeconds(20));

        return response()->json(['status'=>'200']);

    }

    public function checkoutPaymentDonation(Request $request)
    {

        $data = [
            'name'           =>     $request->name,
            'email'          =>     "info@nyumbafasta.co.tz",
            'phone'          =>     $request->contact,
            'amount'         =>     $request->amount,
            'house_id'       =>     0,
            'user_id'        =>     0,
            'transaction_id' =>     Str::random(10),
            'no_redirection' =>     true,
        ];

        Selcom::checkout($data);

        // Fetch the orderId of the current checkout payment
        $orderId = DB::table('selcom_payments')
                        ->where('transid', $data['transaction_id'])
                        ->value('order_id');

        // Query the status from Selcom after a certain time. Use a Laravel Job or Scheduler
        // and dispatch it after 20 seconds

        UpdateSelcomPayment::dispatch($orderId)
                            ->delay(now()->addSeconds(20));

        return response()->json(['status'=>'200']);

    }

    public function checkoutPaymentCardDonation(Request $request)
    {


        $data = [
            'name'           =>     $request->name,
            'email'          =>     "info@nyumbafasta.co.tz",
            'phone'          =>     $request->contact,
            'amount'         =>     $request->amount,
            'house_id'       =>     0,
            'user_id'        =>     0,
            'transaction_id' =>     Str::random(10),
            'no_redirection' =>     true,
            'address'        =>     "Tanzania",
            'postcode'       =>     "255",
        ];

        Selcom::cardCheckout($data);

        // Fetch the orderId of the current checkout payment
        $orderId = DB::table('selcom_payments')
                        ->where('transid', $data['transaction_id'])
                        ->value('order_id');

        // Query the status from Selcom after a certain time. Use a Laravel Job or Scheduler
        // and dispatch it after 20 seconds

        UpdateSelcomPayment::dispatch($orderId)
                            ->delay(now()->addSeconds(20));

        return response()->json(['status'=>'200']);

    }

}
