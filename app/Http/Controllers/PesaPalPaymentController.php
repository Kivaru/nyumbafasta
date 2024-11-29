<?php

namespace App\Http\Controllers;
use Bryceandy\Laravel_Pesapal\Facades\Pesapal;
use Bryceandy\Laravel_Pesapal\Payment;
use Illuminate\Http\Request;

class PesaPalPaymentController extends Controller
{
    public function index()
    {
        $transaction = Pesapal::getTransactionDetails(
            request('pesapal_merchant_reference'), request('pesapal_transaction_tracking_id')
        );
        
        // Store the paymentMethod, trackingId and status in the database
        Payment::modify($transaction);

        $status = $transaction['status'];
        // also $status = Pesapal::statusByTrackingIdAndMerchantRef(request('pesapal_merchant_reference'), request('pesapal_transaction_tracking_id'));
        // also $status = Pesapal::statusByMerchantRef(request('pesapal_merchant_reference'));

        return view('pesapalCallBackView', compact('status')); // Display this status to the user. Values are (PENDING, COMPLETED, INVALID, or FAILED)
    
    }
}
