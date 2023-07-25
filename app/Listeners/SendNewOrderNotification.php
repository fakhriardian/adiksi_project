<?php

namespace App\Listeners;

use App\Models\Order;
use App\Events\NewOrderEvent;
use App\Events\NewOrderNotificationEvent;
use Illuminate\Support\Facades\Notification;

class SendNewOrderNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\NewOrderEvent  $event
     * @return void
     */
    public function handle(NewOrderEvent $event)
    {
        $notification = new Order();
        $notification->message = 'New order received';
        $notification->status = 'unread';
        $notification->save();

        // Trigger the client-side event
        broadcast(new NewOrderNotificationEvent($notification))->toOthers();
    }
}
