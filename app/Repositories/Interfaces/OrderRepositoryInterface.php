<?php

namespace App\Repositories\Interfaces;

interface OrderRepositoryInterface
{
    public function createOrder(array $data, $qty, $packPrice, $packID);
}
