<?php

namespace App\Repositories\Interfaces;

use App\Models\Pagamento;

interface PaymentRepositoryInterface
{
    public function enableDisable(int $id, int $active): bool;
    public function create(Pagamento $pagamento): bool;
}
