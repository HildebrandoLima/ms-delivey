<?php

namespace App\Services\Order\Interfaces;

interface IDeleteOrderService
{
    public function deleteOrder(int $id): int;
}
