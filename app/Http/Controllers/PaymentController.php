<?php

namespace App\Http\Controllers;

use App\Exceptions\SystemDefaultException;
use App\Http\Requests\Payment\CreatePaymentRequest;
use App\Services\Payment\Interfaces\CreatePaymentServiceInterface;
use Symfony\Component\HttpFoundation\Response;

class PaymentController extends Controller
{
    private CreatePaymentServiceInterface $createPaymentService;

    public function __construct(CreatePaymentServiceInterface $createPaymentService)
    {
        $this->createPaymentService = $createPaymentService;
    }

    public function store(CreatePaymentRequest $request): Response
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
