<?php

namespace App\Services\Payment\Interfaces;

use App\Http\Requests\Payment\CreatePaymentRequest;

interface CreatePaymentServiceInterface
{
    public function createPayment(CreatePaymentRequest $request): bool;
}
