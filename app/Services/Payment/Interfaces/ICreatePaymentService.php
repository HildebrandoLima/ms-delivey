<?php

namespace App\Services\Payment\Interfaces;

use App\Http\Requests\PaymentRequest;

interface ICreatePaymentService
{
    public function createPayment(PaymentRequest $request): bool;
}
