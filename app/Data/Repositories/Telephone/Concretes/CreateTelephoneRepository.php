<?php

namespace App\Data\Repositories\Telephone\Concretes;

use App\Data\Infra\Database\DBConnection;
use App\Data\Repositories\Telephone\Interfaces\ICreateTelephoneRepository;
use App\Domains\Traits\DefaultConditionActive;
use App\Exceptions\HttpInternalServerError;
use App\Models\Telefone;
use Illuminate\Http\Exceptions\HttpResponseException;
use Exception;

class CreateTelephoneRepository extends DBConnection implements ICreateTelephoneRepository
{
    use DefaultConditionActive;

    public function create(array $telephone): bool
    {
        try {
            $this->db->beginTransaction();
            Telefone::query()
            ->create([
                'numero' => $telephone['numero'],
                'tipo' => $telephone['tipo'],
                'usuario_id' => $telephone['usuarioId'] ?? null,
                'fornecedor_id' => $telephone['fornecedorId'] ?? null,
                'ativo' => $this->defaultConditionActive(true)
            ]);
            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw new HttpResponseException(HttpInternalServerError::getResponse($e));
        }
    }
}
