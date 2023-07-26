<?php

namespace App\Services\Order\Interfaces;

interface DeleteOrderServiceInterface
{
    public function deleteOrder(int $id, bool $active): bool;
}
