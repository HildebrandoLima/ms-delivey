<?php

namespace App\Data\Repositories\Address\Concretes;

use App\Data\Repositories\Address\Interfaces\IUpdateAddressRepository;
use App\Domains\Traits\DefaultConditionActive;
use App\Exceptions\HttpInternalServerError;
use App\Http\Requests\Address\UpdateAddressRequest;
use App\Models\Endereco;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;
use Exception;

class UpdateAddressRepository implements IUpdateAddressRepository
{
    use DefaultConditionActive;

    public function update(UpdateAddressRequest $request): bool
    {
        try {
            DB::beginTransaction();
            Endereco::query()
            ->where('id', $request->id)
            ->update([
                'logradouro' => $request->logradouro,
                'numero' => $request->numero,
                'bairro' => $request->bairro,
                'cidade' => $request->cidade,
                'cep' => $request->cep,
                'uf' => $request->uf,
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
