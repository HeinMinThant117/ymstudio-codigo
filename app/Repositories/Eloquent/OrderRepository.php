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
        return $order->with('classPacks')->first()->toArray();
    }
}
