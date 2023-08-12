<?php

namespace App\Services\Payment\Abstracts;

use App\Http\Requests\Payment\CreatePaymentRequest;

interface ICreatePaymentService
{
    public function createPayment(CreatePaymentRequest $request): bool;
}
