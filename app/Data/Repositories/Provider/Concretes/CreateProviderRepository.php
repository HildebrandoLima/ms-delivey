<?php

namespace App\Data\Repositories\Provider\Concretes;

use App\Data\Infra\Database\DBConnection;
use App\Data\Repositories\Provider\Interfaces\ICreateProviderRepository;
use App\Domains\Traits\DefaultConditionActive;
use App\Exceptions\HttpInternalServerError;
use App\Http\Requests\Provider\CreateProviderRequest;
use App\Models\Fornecedor;
use Illuminate\Http\Exceptions\HttpResponseException;
use Exception;

class CreateProviderRepository extends DBConnection implements ICreateProviderRepository
{
    use DefaultConditionActive;

    public function create(CreateProviderRequest $request): int
    {
        try {
            $this->db->beginTransaction();
            $providerId = Fornecedor::query()
            ->create([
                'razao_social' => $request->razaoSocial,
                'cnpj' => $request->cnpj,
                'email' => $request->email,
                'data_fundacao' => $request->dataFundacao,
                'ativo' => $this->defaultConditionActive(true)
            ])->orderBy('id', 'desc')->first()->id;
            $this->db->commit();
            return $providerId;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw new HttpResponseException(HttpInternalServerError::getResponse($e));
        }
    }
}
