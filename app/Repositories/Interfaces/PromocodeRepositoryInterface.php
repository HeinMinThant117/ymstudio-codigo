<?php

namespace App\Repositories\Interfaces;

interface PromocodeRepositoryInterface
{
    public function createPromocode(array $data);
    public function checkPromocode($code);
}
