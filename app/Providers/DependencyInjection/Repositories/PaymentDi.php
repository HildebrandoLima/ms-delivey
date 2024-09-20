<?php

namespace App\Providers\DependencyInjection\Repositories;

use App\Data\Repositories\Payment\Concretes\CreatePaymentRepository;
use App\Data\Repositories\Payment\Interfaces\ICreatePaymentRepository;

class PaymentDi
{
    public static $interfaces = [
        ICreatePaymentRepository::class
    ];

    public static $concretes = [
        CreatePaymentRepository::class
    ];
}
