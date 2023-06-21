<?php

namespace App\Repositories\Interfaces;

use App\DataTransferObjects\Dtos\PaymentDto;

interface PaymentRepositoryInterface
{
    public function enableDisable(int $id, int $active): bool;
    public function create(PaymentDto $paymentDto): bool;
}
