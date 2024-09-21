<?php

namespace App\Providers\DependencyInjection\Services;

use App\Domains\Services\Payment\Concretes\CreatePaymentService;

use App\Domains\Services\Payment\Interfaces\ICreatePaymentService;

class PaymentDi
{
    public static $interfaces = [
        ICreatePaymentService::class,
    ];

    public static $concretes = [
        CreatePaymentService::class,
    ];
}
