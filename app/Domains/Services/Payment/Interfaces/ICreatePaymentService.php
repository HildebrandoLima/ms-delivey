<?php

namespace App\Domains\Services\Payment\Interfaces;

use App\Http\Requests\Payment\CreatePaymentRequest;

interface ICreatePaymentService
{
    public function create(CreatePaymentRequest $request): bool;
}
