<?php

namespace App\Http\Controllers;

use App\Domains\Services\Payment\Abstracts\ICreatePaymentService;
use App\Exceptions\SystemDefaultException;
use App\Http\Requests\Payment\CreatePaymentRequest;
use Symfony\Component\HttpFoundation\Response;

class PaymentController extends Controller
{
    private ICreatePaymentService $createPaymentService;

    public function __construct(ICreatePaymentService $createPaymentService)
    {
        $this->createPaymentService = $createPaymentService;
    }

    public function store(CreatePaymentRequest $request): Response
    {
        try {
            $success = $this->createPaymentService->createPayment($request);
            return Controller::post($success);
        } catch (SystemDefaultException $e) {
            return Controller::error($e);
        }
    }
}
