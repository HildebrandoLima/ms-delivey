<?php

namespace App\Repositories\Concretes;

use App\Models\Pagamento;
use App\Repositories\Interfaces\PaymentRepositoryInterface;

class PaymentRepository implements PaymentRepositoryInterface
{
    public function enableDisable(int $id, bool $active): bool
    {
        return Pagamento::query()->where('pedido_id', '=', $id)->update(['ativo' => $active]);
    }

    public function create(Pagamento $pagamento): bool
    {
        Pagamento::query()->create($pagamento->toArray());
        return true;
    }    
}
