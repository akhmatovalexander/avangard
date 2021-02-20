<?php

namespace App\Listeners;

use App\Events\OrderCompleted;
use App\Mail\OrderCompleted as OrderCompletedMail;
use Illuminate\Support\Facades\Mail;

class OrderCompletedListener
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
     * @param  OrderCompleted  $event
     * @return void
     */
    public function handle(OrderCompleted $event)
    {
        $orderId = $event->order->id;
        $products = $event->order->getProductsNames();
        $price = $event->order->getOverallOrderPrice();

        Mail::to($event->order->partner->email)
            ->send(new OrderCompletedMail($orderId, $products, $price));

        foreach ($event->order->orderProducts as $orderProduct) {
            $vendor = $orderProduct->product->vendor;
            Mail::to($vendor->email)
                ->send(new OrderCompletedMail($orderId, $products, $price));
        }

    }
}
