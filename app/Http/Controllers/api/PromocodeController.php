<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\PromocodeRepositoryInterface;
use Illuminate\Http\Request;

class PromocodeController extends Controller
{
    private PromocodeRepositoryInterface $promocodeRepository;

    public function __construct(PromocodeRepositoryInterface $promocodeRepository)
    {
        $this->promocodeRepository = $promocodeRepository;
    }

    public function store()
    {
        $validated = request()->validate(['discount' => 'required|integer|between:5,20']);

        return $this->promocodeRepository->createPromocode([
            'promo_code' => $this->generateCode(),
            'discount' => $validated['discount']
        ]);
    }

    public function verify()
    {
        $validated = request()->validate(['promo_code' => 'required']);
        return $this->promocodeRepository->checkPromocode($validated['promo_code']);
    }

    public function apply()
    {
        return $this->promocodeRepository->applyPromocode(request('promo_code'));
    }

    private function generateCode()
    {
        $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $res = "";
        for ($i = 0; $i < 10; $i++) {
            $res .= $chars[mt_rand(0, strlen($chars) - 1)];
        }

        return $res;
    }
}
