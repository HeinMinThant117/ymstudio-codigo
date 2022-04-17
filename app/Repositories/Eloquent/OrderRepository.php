<?php

namespace App\Repositories\Eloquent;

use App\Models\Order;
use App\Repositories\Interfaces\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{
    public function createOrder(array $data, $qty, $packPrice, $packID)
    {
        $order = Order::create($data);

        $order->classPacks()->attach($packID, ['qty' => $qty, 'price' => $packPrice]);
        $order->classPacks;

        return $order;
    }

    public function getUserOrder($orderID)
    {
        $order = auth()->user()->orders()->where('id', $orderID)->first();
        if ($order !== null) {
            $order->classPacks;
        }
        return $order;
    }
}
