<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\ClassPackRepositoryInterface;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    private OrderRepositoryInterface $orderRepository;
    private ClassPackRepositoryInterface $classPackRepository;

    public function __construct(OrderRepositoryInterface $orderRepository, ClassPackRepositoryInterface $classPackRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->classPackRepository = $classPackRepository;
    }

    public function show($id)
    {
        return response()->json(['data' => $this->orderRepository->getUserOrder($id)]);
    }

    public function store()
    {
        $validated = request()->validate(['pack_id' => 'required', 'qty' => 'required|integer']);
        $classPack = $this->classPackRepository->getClassPackByID($validated['pack_id'])->toArray();

        $packPrice = (float)$classPack['pack_price'];
        $gst = ($packPrice * 7) / 100;
        $subtotal = $packPrice - $gst;
        $discount = 0;
        $grandTotal = $packPrice;


        $orderData = [
            'user_id' => auth()->id(),
            'subtotal' => $subtotal,
            'gst' => $gst,
            'discount' => $discount,
            'grand_total' => $grandTotal
        ];
        $order = $this->orderRepository->createOrder($orderData, $validated['qty'], $packPrice, $classPack['pack_id']);

        $this->logInfo('Order', $order->id, 'created');
        Log::channel('mystudio')->info("ClassPackOrder with Order with order id {$order['id']} and class pack id {$order['classPacks'][0]['pack_id']} at " . Carbon::now()->timezone('Asia/Rangoon'));

        return response()->json([
            'data' => $order
        ], 201);
    }

    protected function logInfo($object, $id, $action)
    {
        if (!App::environment('testing')) {
            Log::channel('mystudio')->info("$object with id ${id} ${action} at " . Carbon::now()->timezone('Asia/Rangoon'));
        }
    }
}
