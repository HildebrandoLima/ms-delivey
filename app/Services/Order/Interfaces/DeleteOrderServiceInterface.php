<?php

namespace App\Services\Order\Interfaces;

interface DeleteOrderServiceInterface
{
    public function deleteOrder(int $id, int $active): bool;
}
