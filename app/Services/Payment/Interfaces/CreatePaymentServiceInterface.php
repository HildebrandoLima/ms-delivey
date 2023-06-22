<?php

namespace App\Services\Payment\Interfaces;

use App\Http\Requests\PaymentRequest;

interface CreatePaymentServiceInterface
{
    public function createPayment(PaymentRequest $request): bool;
}
