<?php

namespace App\Data\Repositories\Telephone\Concretes;

use App\Data\Repositories\Telephone\Interfaces\IUpdateTelephoneRepository;
use App\Domains\Traits\DefaultConditionActive;
use App\Exceptions\HttpInternalServerError;
use App\Http\Requests\Telephone\UpdateTelephoneRequest;
use App\Models\Telefone;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;
use Exception;

class UpdateTelephoneRepository implements IUpdateTelephoneRepository
{
    use DefaultConditionActive;

    public function update(UpdateTelephoneRequest $request): bool
    {
        try {
            DB::beginTransaction();
            Telefone::query()
            ->where('id', $request->id)
            ->update([
                'numero' => $request->numero,
                'tipo' => $request->tipo,
                'usuario_id' => $request->usuarioId ?? null,
                'fornecedor_id' => $request->fornecedorId ?? null,
                'ativo' => $this->defaultConditionActive($request->ativo)
            ]);
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw new HttpResponseException(HttpInternalServerError::getResponse($e));
        }
    }
}
