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
        $promocode = Promocode::where('promo_code', '=', $code)->first();
        if (!$promocode) {
            return ['message' => 'Promocode does not exist', 'discount' => null];
        }
        if ($promocode->expired) {
            return ['message' => 'Promocode is expired', 'discount' => null];
        }
        if ($promocode->users->count() > 0) {
            return ['message' => 'You have already applied the promocode', 'discount' => null];
        }

        return ['message' => 'Success', 'discount' => $promocode['discount']];
    }

    public function applyPromocode($code)
    {
        auth()->user()->promocodes()->attach($code);
        return 'success';
    }
}
