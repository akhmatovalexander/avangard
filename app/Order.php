<?php

namespace App;

use App\Events\OrderSaved;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $dispatchesEvents = [
        'saved' => OrderSaved::class
    ];

    public function partner()
    {
        return $this->belongsTo('App\Partner');
    }

    public function orderProducts()
    {
        return $this->hasMany('App\OrderProduct');
    }

    public function scopeOverdue($query)
    {
        return $query
            ->where('delivery_dt', '<', now())
            ->where('status', '=', 10)
            ->orderBy('delivery_dt', 'desc')
            ->limit(50);
    }

    public function scopeCurrent($query)
    {
        return $query
            ->whereBetween('delivery_dt', [now(), now()->addHours(24)])
            ->where('status', '=', 10)
            ->orderBy('delivery_dt');
    }

    public function scopeNew($query)
    {
        return $query
            ->where('delivery_dt', '>', now())
            ->where('status', '=', 0)
            ->orderBy('delivery_dt')
            ->limit(50);
    }

    public function scopeCompleted($query)
    {
        return $query
            ->whereBetween('delivery_dt', [now()->startOfDay(), now()->endOfDay()])
            ->where('status', '=', 20)
            ->orderBy('delivery_dt', 'desc')
            ->limit(50);
    }

    public function getStatuses($status = null)
    {
        $statuses = ['new' => 0, 'confirmed' => 10, 'completed' => 20];
        if ($status !== null) {
            return $statuses[$status];
        }
        return $statuses;
    }

    public function getOverallOrderPrice()
    {
        $orderPrice = 0;
        foreach ($this->orderProducts as $orderProduct) {
            $orderPrice = $orderPrice + $orderProduct->product->price;
        }
        return $orderPrice;
    }

    public function getProductsNames() : array
    {
        $names = [];
        foreach ($this->orderProducts as $orderProduct) {
            array_push($names, $orderProduct->product->name);
        }
        return $names;
    }

    public function getDeliveryDate()
    {
        return $this->delivery_dt;
    }

}
