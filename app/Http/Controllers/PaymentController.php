<?php

namespace App\Http\Controllers;

use App\Exceptions\SystemDefaultException;
use App\Http\Requests\PaymentRequest;
use App\Services\Payment\CreatePaymentService;
use Symfony\Component\HttpFoundation\Response;

class PaymentController extends Controller
{
    private CreatePaymentService $createPaymentService;

    public function __construct(CreatePaymentService $createPaymentService)
    {
        $this->createPaymentService = $createPaymentService;
    }

    public function store(PaymentRequest $request): Response
    {
        try {
            $success = $this->createPaymentService->createPayment($request);
            if (!$success) return Controller::error();
            return Controller::post($success);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }
}
