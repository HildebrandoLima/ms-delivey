<?php

namespace App\Providers\DependencyInjection\Services;

use App\Services\Payment\Abstracts\ICreatePaymentService;
use App\Services\Payment\Concretes\CreatePaymentService;

class PaymentDi
{
    public static $interfaces = [
        ICreatePaymentService::class,
    ];

    public static $concretes = [
        CreatePaymentService::class,
    ];
}
