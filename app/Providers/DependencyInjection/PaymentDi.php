<?php

namespace App\Providers\DependencyInjection;

use App\Data\Repositories\Payment\Concretes\CreatePaymentRepository;
use App\Data\Repositories\Payment\Interfaces\ICreatePaymentRepository;

use App\Domains\Services\Payment\Concretes\CreatePaymentService;
use App\Domains\Services\Payment\Interfaces\ICreatePaymentService;

class PaymentDi extends DependencyInjection
{
    protected function services(): array
    {
        return [
            [ICreatePaymentService::class, CreatePaymentService::class]
        ];
    }

    protected function repositories(): array
    {
        return [
            [ICreatePaymentRepository::class, CreatePaymentRepository::class]
        ];
    }
}
