<?php

namespace App\Http\Controllers;

use App\Events\OrderCompleted;
use App\Http\Requests\UpdateOrder;
use App\Order;
use App\Partner;
use Illuminate\Support\Facades\Cache;

class OrdersController extends Controller
{
    public function index($scope = null)
    {
        $orders = Cache::remember("orders_{$scope}", 1, function () use ($scope) {
            return $this->getOrders($scope);
        });

        return view('orders.index', [
            'orders' => $orders
        ]);
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $partners = Partner::all();

        return view('orders.edit', [
            'order' => $order,
            'partners' => $partners
        ]);
    }

    public function update($id, UpdateOrder $request)
    {
        $validated = $request->validated();

        $order = Order::find($id);
        $partner = Partner::where('name', $validated['partner'])->first();

        $isComplete = $this->isOrderComplete($order, $validated['status']);
        $order->client_email = $validated['email'];
        $order->status = $validated['status'];
        $order->partner_id = $partner->id;
        $order->save();

        if ($isComplete) {
            OrderCompleted::dispatch($order);
        }

        return redirect()->back()->with('message', 'Order updated!');
    }

    protected function getOrders($scope)
    {
        switch ($scope) {
            case 'overdue':
                return Order::overdue()->get();
            case 'current':
                return Order::current()->get();
            case 'new':
                return Order::new()->get();
            case 'completed':
                return Order::completed()->get();
            default:
                return Order::all();
        }
    }

    protected function isOrderComplete($order, $newStatus) : bool
    {
        if ($order->status != $newStatus && $newStatus == $order->getStatuses('completed')) {
            return true;
        }
        return false;
    }
}
