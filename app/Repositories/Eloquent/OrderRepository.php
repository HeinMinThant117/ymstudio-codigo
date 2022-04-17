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
        return auth()->user()->orders()->where('id', $orderID)->first();
    }
}
