<?php

namespace App\Repositories\Eloquent;

use App\Models\Promocode;
use App\Repositories\Interfaces\PromocodeRepositoryInterface;

class PromocodeRepository implements PromocodeRepositoryInterface
{
    public function createPromocode(array $data)
    {
        return Promocode::create($data);
    }

    public function checkPromocode($code)
    {
        return Promocode::where('promo_code', '=', $code)->count();
    }
}
