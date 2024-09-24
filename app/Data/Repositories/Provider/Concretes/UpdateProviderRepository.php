<?php

namespace App\Data\Repositories\Provider\Concretes;

use App\Data\Repositories\Provider\Interfaces\IUpdateProviderRepository;
use App\Domains\Traits\DefaultConditionActive;
use App\Domains\Traits\RequestConfigurator;
use App\Exceptions\HttpInternalServerError;
use App\Http\Requests\Provider\UpdateProviderRequest;
use App\Models\Endereco;
use App\Models\Fornecedor;
use App\Models\Telefone;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;
use Exception;

class UpdateProviderRepository implements IUpdateProviderRepository
{
    use DefaultConditionActive, RequestConfigurator;

    public function update(UpdateProviderRequest $request): bool
    {
        try {
            $this->setRequest($request);
            DB::beginTransaction();
            $this->updateEntity();
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw new HttpResponseException(HttpInternalServerError::getResponse($e));
        }
    }

    private function updateEntity(): void
    {
        $this->updatedAddress();
        $this->updatedPhone();
        $this->updatedProvider();
    }

    private function updatedAddress(): void
    {
        $this->updateModel(Endereco::class, [
            'ativo' => $this->defaultConditionActive($this->request->ativo)
        ], 'fornecedor_id');
    }

    private function updatedPhone(): void
    {
        $this->updateModel(Telefone::class, [
            'ativo' => $this->defaultConditionActive($this->request->ativo)
        ], 'fornecedor_id');
    }

    private function updatedProvider(): void
    {
        $this->updateModel(Fornecedor::class, [
            'razao_social' => $this->request->razaoSocial,
            'cnpj' => $this->request->cnpj,
            'email' => $this->request->email,
            'ativo' => $this->defaultConditionActive($this->request->ativo)
        ], 'id');
    }

    private function updateModel(string  $model, array $data, string $column): void
    {
        $model::query()
        ->where($column, $this->request->id)
        ->update($data);
    }
}
