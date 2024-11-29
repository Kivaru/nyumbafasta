<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Bryceandy\Selcom\Events\CheckoutWebhookReceived;
use Bryceandy\Selcom\Facades\Selcom;
use Illuminate\Support\Facades\DB;

class ProcessWebhook
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function handle(CheckoutWebhookReceived $event)
    {
        // Get the order id
        $orderId = $event->orderId;

        // Fetch updated record in the database, and do what you need with it
        $status = DB::table('selcom_payments')
            ->where('order_id', $orderId)
            ->value('payment_status');

        if ($status === 'PENDING') {
            Selcom::orderStatus($orderId); // Or dispatch a job minutes later to query order status
        }
    }


    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
