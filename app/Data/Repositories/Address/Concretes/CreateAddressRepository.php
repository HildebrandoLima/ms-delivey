<?php

namespace App\Data\Repositories\Address\Concretes;

use App\Data\Repositories\Address\Interfaces\ICreateAddressRepository;
use App\Domains\Traits\DefaultConditionActive;
use App\Exceptions\HttpInternalServerError;
use App\Http\Requests\Address\CreateAddressRequest;
use App\Models\Endereco;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;
use Exception;

class CreateAddressRepository implements ICreateAddressRepository
{
    use DefaultConditionActive;

    public function create(CreateAddressRequest $request): bool
    {
        try {
            DB::beginTransaction();
            Endereco::query()->create([
                'logradouro' => $request->logradouro,
                'numero' => $request->numero,
                'bairro' => $request->bairro,
                'cidade' => $request->cidade,
                'cep' => $request->cep,
                'uf' => $request->uf,
                'usuario_id' => $request->usuarioId ?? null,
                'fornecedor_id' => $request->fornecedorId ?? null,
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
