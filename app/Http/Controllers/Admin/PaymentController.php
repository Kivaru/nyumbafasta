<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Payment;
use Bryceandy\Beem\Facades\Beem;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function indexCompletedTransactions(){

        $completedTransactions = Payment::with('user')->where('payment_status', '=', "COMPLETED")->latest()->get();

        return view('admin.payment.completed', compact('completedTransactions'));

    }

    public function indexPendingTransactionseven()
    {
        $pendingTransactions = Payment::with('user')
            ->whereNull('payment_status')
            ->orWhere('payment_status', 'PENDING')
            ->latest()
            ->pluck('id');
    
        $evenIDs = [];
    
        foreach ($pendingTransactions as $transaction) {
            
            if ($transaction % 2 == 0) {

                array_push($evenIDs, $transaction);
            }

            $pendingTransactions = Payment::with('user')
                                            ->whereNull('payment_status')
                                            ->whereIn('id', $evenIDs)
                                            ->latest()
                                            ->get();
        }
       
       return view('admin.payment.pending_even', compact('pendingTransactions'));
    }
    
    



    public function indexPendingTransactionsodd()
    {
        $pendingTransactionids = Payment::with('user')
            ->whereNull('payment_status')
            ->orWhere('payment_status', 'PENDING')
            ->latest()
            ->pluck('id');
    
    $oddIDs = [];
    
        foreach ($pendingTransactionids as $transaction) {
        
            if ($transaction % 2 != 0) {

                array_push($oddIDs, $transaction);

            }
        }

        $pendingTransactions = Payment::with('user')
                                        ->whereNull('payment_status')
                                        ->whereIn('id', $oddIDs)
                                        ->latest()
                                        ->get();
    
        return view('admin.payment.pending_even', compact('pendingTransactions'));
    }

    public function sendMesageToRenter(Request $request){

        if (strpos($request->phone, '0') === 0) {
            $phoneNumber = "255".substr($request->phone,1);
         }else{
            $phoneNumber = $request->phone;
         }

        $transaction = Payment::find($request->transaction_id);

        $recipient = [
            [
                'recipient_id' => (string) $request->renter_id,
                'dest_addr' => (string) $phoneNumber,
            ]
        ];

        $transaction->message_status = 1;
        $transaction->save();

        Beem::sms($request->message, $recipient, 'NYUMBAFASTA');

        return redirect()->back();


    }

}
