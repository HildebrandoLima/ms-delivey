<?php

namespace App\Data\Repositories\Payment\Interfaces;

use App\Http\Requests\Payment\CreatePaymentRequest;

interface ICreatePaymentRepository
{
    public function create(CreatePaymentRequest $request): bool;
}
