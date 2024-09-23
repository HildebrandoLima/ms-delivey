<?php

namespace App\Data\Repositories\Provider\Concretes;

use App\Data\Repositories\Provider\Interfaces\ICreateProviderRepository;
use App\Domains\Traits\DefaultConditionActive;
use App\Exceptions\HttpInternalServerError;
use App\Http\Requests\Provider\CreateProviderRequest;
use App\Models\Fornecedor;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;
use Exception;

class CreateProviderRepository implements ICreateProviderRepository
{
    use DefaultConditionActive;

    public function create(CreateProviderRequest $request): int
    {
        try {
            DB::beginTransaction();
            $providerId = Fornecedor::query()
            ->create([
                'razao_social' => $request->razaoSocial,
                'cnpj' => $request->cnpj,
                'email' => $request->email,
                'data_fundacao' => $request->dataFundacao,
                'ativo' => $this->defaultConditionActive(true)
            ]);
            DB::commit();
            return $providerId->id;
        } catch (Exception $e) {
            DB::rollBack();
            throw new HttpResponseException(HttpInternalServerError::getResponse($e));
        }
    }
}
