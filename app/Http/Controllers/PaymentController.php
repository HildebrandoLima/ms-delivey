<?php

namespace App\Http\Controllers;

use App\Domains\Services\Payment\Interfaces\ICreatePaymentService;
use App\Http\Requests\Payment\CreatePaymentRequest;
use Symfony\Component\HttpFoundation\Response;
use Exception;

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
            $success = $this->createPaymentService->create($request);
            return Controller::post($success);
        } catch (Exception $e) {
            return Controller::error($e);
        }
    }
}
