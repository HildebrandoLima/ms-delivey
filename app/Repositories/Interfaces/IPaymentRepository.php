<?php

namespace App\Repositories\Interfaces;

use App\Models\Pagamento;
use Illuminate\Support\Collection;

interface IPaymentRepository {
    public function insert(Pagamento $pagamento): bool;
    public function update(int $id, Pagamento $pagamento): bool;
    public function delete(int $id): bool;
    public function getAll(int $id): Collection;
}
