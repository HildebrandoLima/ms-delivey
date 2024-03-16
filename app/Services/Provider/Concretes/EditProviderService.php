<?php

namespace App\Services\Provider\Concretes;

use App\Data\Repositories\Abstracts\IEntityRepository;
use App\Http\Requests\Provider\EditProviderRequest;
use App\Models\Endereco;
use App\Models\Fornecedor;
use App\Models\Telefone;
use App\Services\Provider\Abstracts\IEditProviderService;
use App\Support\Enums\AtivoEnum;

class EditProviderService implements IEditProviderService
{
    private IEntityRepository $providerRepository;

    public function __construct(IEntityRepository $providerRepository)
    {
        $this->providerRepository = $providerRepository;
    }

    public function editProvider(EditProviderRequest $request): bool
    {
        $listAddressAndTelephone = $this->providerRepository->read((new Fornecedor()), $request->id);

        foreach ($listAddressAndTelephone as $instance):
            $address = $this->mapAddress($instance->enderecoId, $request->ativo);
            $this->providerRepository->update($address);
        endforeach;

        foreach ($listAddressAndTelephone as $instance):
            $telephone = $this->mapAddress($instance->telefoneId, $request->ativo);
            $this->providerRepository->update($telephone);
        endforeach;

        $provider = $this->mapProvider($request);
        return $this->providerRepository->update($provider);
    }

    public function mapAddress(int $id, bool $ativo): Endereco
    {
        $address = new Endereco();
        $address->id = $id;
        $address->ativo = $ativo == true ? AtivoEnum::ATIVADO : AtivoEnum::DESATIVADO;
        return $address;
    }

    public function mapTelephone(int $id, bool $ativo): Telefone
    {
        $address = new Telefone();
        $address->id = $id;
        $address->ativo = $ativo == true ? AtivoEnum::ATIVADO : AtivoEnum::DESATIVADO;
        return $address;
    }

    public function mapProvider(EditProviderRequest $request): Fornecedor
    {
        $provider = new Fornecedor();
        $provider->id = $request->id;
        $provider->razao_social = $request->razaoSocial;
        $provider->cnpj = $request->cnpj;
        $provider->email = $request->email;
        $provider->ativo = $request->ativo == true ? AtivoEnum::ATIVADO : AtivoEnum::DESATIVADO;
        return $provider;
    }
}
