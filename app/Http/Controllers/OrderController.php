<?php

namespace App\Http\Controllers;

use App\Exceptions\SystemDefaultException;
use App\Http\Requests\OrderRequest;
use App\Services\Order\CreateOrderService;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    private CreateOrderService $createOrderService;

    public function __construct
    (
        CreateOrderService $createOrderService
    )
    {
        $this->createOrderService = $createOrderService;
    }

    public function store(OrderRequest $request): Response
    {
        try {
            $success = $this->createOrderService->createOrder($request);
            if (!$success) return Controller::error();
            return Controller::post($success);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }
}
