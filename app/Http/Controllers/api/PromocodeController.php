<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\PromocodeRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

        $promocode =  $this->promocodeRepository->createPromocode([
            'promo_code' => $this->generateCode(),
            'discount' => $validated['discount']
        ]);


        Log::channel('mystudio')->info("Promocode with {$promocode['promo_code']} created at " . Carbon::now()->timezone('Asia/Rangoon'));

        return $promocode;
    }

    public function verify()
    {
        $validated = request()->validate(['promo_code' => 'required']);
        $promocodeStatus = $this->promocodeRepository->checkPromocode($validated['promo_code']);
        if ($promocodeStatus['message'] === 'success') {
            return response()->json(['data' => $promocodeStatus], 200);
        }

        return response()->json($promocodeStatus, 422);
    }

    public function apply()
    {
        $promocode = request('promo_code');
        $promocodeStatus = $this->promocodeRepository->applyPromocode($promocode);

        $user_id = auth()->id();
        if ($promocodeStatus === 'Success') {
            Log::channel('mystudio')->info("PromocodeUser with promocode {$promocode} and user_id {$user_id}");
            return response()->json([
                'message' => 'success'
            ], 200);
        }

        return response()->json([
            'message' => $promocodeStatus
        ], 422);
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
