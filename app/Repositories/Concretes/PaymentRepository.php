<?php

namespace App\Repositories\Concretes;

use App\DataTransferObjects\Dtos\PaymentDto;
use App\Models\Pagamento;
use App\Repositories\Interfaces\PaymentRepositoryInterface;

class PaymentRepository implements PaymentRepositoryInterface
{
    public function enableDisable(int $id, int $active): bool
    {
        return Pagamento::query()->where('pedido_id', '=', $id)->update(['ativo' => $active]);
    }

    public function create(PaymentDto $paymentDto): bool
    {
        Pagamento::query()->create((array)$paymentDto);
        return true;
    }    
}
