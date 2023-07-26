<?php

namespace App\Services\Payment\Interfaces;

use App\Http\Requests\Payment\PaymentRequest;

interface CreatePaymentServiceInterface
{
    public function createPayment(PaymentRequest $request): bool;
}
