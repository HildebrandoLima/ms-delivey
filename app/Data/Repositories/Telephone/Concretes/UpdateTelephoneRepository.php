<?php

namespace App\Data\Repositories\Telephone\Concretes;

use App\Data\Infra\Database\DBConnection;
use App\Data\Repositories\Telephone\Interfaces\IUpdateTelephoneRepository;
use App\Domains\Traits\DefaultConditionActive;
use App\Exceptions\HttpInternalServerError;
use App\Http\Requests\Telephone\EditTelephoneRequest;
use App\Models\Telefone;
use Illuminate\Http\Exceptions\HttpResponseException;
use Exception;

class UpdateTelephoneRepository extends DBConnection implements IUpdateTelephoneRepository
{
    use DefaultConditionActive;

    public function update(EditTelephoneRequest $request): bool
    {
        try {
            $this->db->beginTransaction();
            Telefone::query()
            ->where('id', $request->id)
            ->update([
                'numero' => $request->numero,
                'tipo' => $request->tipo,
                'usuario_id' => $request->usuarioId ?? null,
                'fornecedor_id' => $request->fornecedorId ?? null,
                'ativo' => $this->defaultConditionActive($request->ativo)
            ]);
            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw new HttpResponseException(HttpInternalServerError::getResponse($e));
        }
    }
}
