<?php

namespace App\Repositories;

use App\Models\Pagamento;
use App\Repositories\Interfaces\IPaymentRepository;
use Illuminate\Support\Collection;

class PaymentRepository implements IPaymentRepository {
    public function insert(Pagamento $pagamento): bool
    {
        return Pagamento::query()->insert($pagamento->toArray());
    }

    public function update(int $id, Pagamento $pagamento): bool
    {
        return true;
    }

    public function delete(int $id): bool
    {
        return true;
    }

    public function getAll(int $id): Collection
    {
        return collect();
    }
}
