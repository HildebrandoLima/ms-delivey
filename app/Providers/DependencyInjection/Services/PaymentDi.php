<?php

namespace App\Providers\DependencyInjection\Services;

use App\Domains\Services\Payment\Abstracts\ICreatePaymentService;
use App\Domains\Services\Payment\Concretes\CreatePaymentService;

class PaymentDi
{
    public static $interfaces = [
        ICreatePaymentService::class,
    ];

    public static $concretes = [
        CreatePaymentService::class,
    ];
}
