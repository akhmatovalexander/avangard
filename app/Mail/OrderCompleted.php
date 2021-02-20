<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderCompleted extends Mailable
{
    use Queueable, SerializesModels;

    public $orderId;

    public $products;

    public $price;

    /**
     * OrderCompleted constructor.
     * @param $orderId
     * @param $products
     * @param $price
     */
    public function __construct($orderId, array $products, $price)
    {
        $this->orderId = $orderId;
        $this->products = $products;
        $this->price = $price;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.order-completed', [
            'number' => $this->orderId,
            'products' => $this->products,
            'price' => $this->price
        ])->subject("Заказ №{{ $this->orderId }} завершен!");
    }
}
