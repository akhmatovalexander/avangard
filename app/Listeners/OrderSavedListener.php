<?php

namespace App\Listeners;

use App\Events\OrderSaved;
use Illuminate\Support\Facades\Cache;

class OrderSavedListener
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
     * @param  OrderSaved  $event
     * @return void
     */
    public function handle(OrderSaved $event)
    {
        //Cache::tags(['orders'])->flush();

        Cache::forget('orders_');
        Cache::forget('orders_overdue');
        Cache::forget('orders_current');
        Cache::forget('orders_new');
        Cache::forget('orders_completed');
    }
}
