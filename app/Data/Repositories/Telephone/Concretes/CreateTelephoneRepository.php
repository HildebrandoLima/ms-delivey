<?php

namespace App\Data\Repositories\Telephone\Concretes;

use App\Data\Repositories\Telephone\Interfaces\ICreateTelephoneRepository;
use App\Domains\Traits\DefaultConditionActive;
use App\Exceptions\HttpInternalServerError;
use App\Models\Telefone;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;
use Exception;

class CreateTelephoneRepository implements ICreateTelephoneRepository
{
    use DefaultConditionActive;

    public function create(array $telephone): bool
    {
        try {
            DB::beginTransaction();
            Telefone::query()
            ->create([
                'numero' => $telephone['numero'],
                'tipo' => $telephone['tipo'],
                'usuario_id' => $telephone['usuarioId'] ?? null,
                'fornecedor_id' => $telephone['fornecedorId'] ?? null,
                'ativo' => $this->defaultConditionActive(true)
            ]);
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw new HttpResponseException(HttpInternalServerError::getResponse($e));
        }
    }
}
