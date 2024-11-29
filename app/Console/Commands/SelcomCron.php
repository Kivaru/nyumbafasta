<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Bryceandy\Selcom\Facades\Selcom;
use DB;
use Bryceandy\Beem\Facades\Beem;

class SelcomCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'selcom:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Selcom Payment Callback Cron Job Command';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
         // Query order status from Selcom Table to check if 

    $orders = DB::table('selcom_payments')->select('order_id')->where('status', '=', null)->get();


    foreach($orders as $check_order){
       
        if(!empty($check_order)){
        $order = Selcom::orderStatus($check_order->order_id);

        //  \Log::info($order);

        var_dump($order);
         
            if($order['data'][0]['payment_status'] === 'PENDING') {
            }
            else {
                // Update the table
                // \Log::info("Cron is working fine and order has been paid successfully!", $check_order->order_id);
                // echo "Cron is working fine and order has been paid successfully!", $check_order->order_id;
                DB::table('selcom_payments')
                    ->where('order_id', $check_order->order_id)
                    ->update([
                        'payment_status' => $order['data'][0]['payment_status'],
                        'updated_at' => now(),
                        'reference' => $order['data'][0]['reference'] ?? null,
                        'selcom_transaction_id' => $order['data'][0]['transid'] ?? null,
                        'channel' => $order['data'][0]['channel'] ?? null,
                        'msisdn' => $order['data'][0]['msisdn'] ?? null,
                        'status' => 1,
                    ]);

                    var_dump("Cron is working fine and order has been paid successfully!", $check_order->order_id);
        
                    // $merchant = DB::table('selcom_payments')
                    // ->where('order_id', $check_order->order_id)
                    // ->first();
 
                    //  $user = User::where('id', $merchant->shop_id)->first();
 
                //      $message_to_send = "Payment with Order Number ". $check_order->order_id ." has been paid successfully";
 
                //      $source_addr="0685787560";
 
                //      $recipients = [
                //                  [
                //                      'recipient_id' => $merchant->shop_id,
                //                      'dest_addr' => $user->phonenumber,
                //                  ],
                //               ];
                    
                //  Beem::sms($message_to_send, $recipients, 'Dukabox');
            }
         }
     }  



    }
}
