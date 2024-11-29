<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Bryceandy\Selcom\Facades\Selcom;
use DB;

class UpdateSelcomPayment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 0;
    public $orderId;

    public function __construct($orderId)
    {
        $this->orderId = $orderId;
    }

    public function retryUntil()
    {
        // We may set that the job should expire after 5 mins
        return now()->addMinutes(30);
    }

    public function handle()
    {
       // Query order status from Selcom
       $order = Selcom::orderStatus($this->orderId);

        if ($order['payment_status'] === 'COMPLETED') {

             // Update the table
             DB::table('selcom_payments')
             ->where('order_id', $this->orderId)
             ->update([
                 'payment_status' => $order['payment_status'],
                 'updated_at' => now(),
                 'reference' => $order['reference'] ?? null,
                 'selcom_transaction_id' => $order['transid'] ?? null,
                 'channel' => $order['channel'] ?? null,
                 'msisdn' => $order['msisdn'] ?? null,
             ]);
        }
        else {
            // Send the job back to the queue again after maybe 1 minute, so that this job will be retried
            $this->release(now()->addMinute());
            // DB::table('selcom_payments')
            // ->where('order_id', $this->orderId)
            // ->update([
            //     'payment_status' => "PENDING",
            //     'updated_at' => now(),
            // ]);
            // $this->release(now()->addMinute());
        }
    }
}
