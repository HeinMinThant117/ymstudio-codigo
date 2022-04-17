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
            return ['message' => 'Promocode does not exist'];
        }
        if ($promocode->expired) {
            return ['message' => 'Promocode is expired'];
        }
        foreach ($promocode->users as $user) {
            if ($user->id == auth()->id()) {
                return ['message' => 'You have already applied the promocode'];
            }
        }

        return ['message' => 'success', 'discount' => $promocode['discount'], 'code' => $promocode['promo_code']];
    }

    public function applyPromocode($code)
    {
        $promocode = Promocode::where('promo_code', '=', $code)->first();
        if (!$promocode) {
            return 'Code doesnt exist';
        }


        auth()->user()->promocodes()->attach($code);
        return 'Success';
    }
}
