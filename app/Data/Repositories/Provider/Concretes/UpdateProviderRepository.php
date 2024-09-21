<?php

namespace App\Data\Repositories\Provider\Concretes;

use App\Data\Infra\Database\DBConnection;
use App\Data\Repositories\Provider\Interfaces\IUpdateProviderRepository;
use App\Domains\Traits\DefaultConditionActive;
use App\Exceptions\HttpInternalServerError;
use App\Http\Requests\Provider\UpdateProviderRequest;
use App\Models\Endereco;
use App\Models\Fornecedor;
use App\Models\Telefone;
use Illuminate\Http\Exceptions\HttpResponseException;
use Exception;

class UpdateProviderRepository extends DBConnection implements IUpdateProviderRepository
{
    use DefaultConditionActive;

    private UpdateProviderRequest $request;

    public function update(UpdateProviderRequest $request): bool
    {
        try {
            $this->request = $request;
            $this->db->beginTransaction();
            $this->updateEntity();
            $this->updateProvider();
            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw new HttpResponseException(HttpInternalServerError::getResponse($e));
        }
    }

    private function updateEntity(): void
    {
        $this->updateAddress();
        $this->updatePhone();
    }

    private function updateAddress(): void
    {
        Endereco::query()
        ->where('fornecedor_id', $this->request->id)
        ->update([
            'ativo' => $this->defaultConditionActive($this->request->ativo)
        ]);
    }

    private function updatePhone(): void
    {
        Telefone::query()
        ->where('fornecedor_id', $this->request->id)
        ->update([
            'ativo' => $this->defaultConditionActive($this->request->ativo)
        ]);
    }

    private function updateProvider(): void
    {
        Fornecedor::query()
        ->where('id', $this->request->id)
        ->update([
            'razao_social' => $this->request->razaoSocial,
            'cnpj' => $this->request->cnpj,
            'email' => $this->request->email,
            'ativo' => $this->defaultConditionActive($this->request->ativo)
        ]);
    }
}
