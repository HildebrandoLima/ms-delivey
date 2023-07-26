<?php

namespace App\Services\Provider\Concretes;

use App\Repositories\Interfaces\AddressRepositoryInterface;
use App\Repositories\Interfaces\ImageRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\Interfaces\ProviderRepositoryInterface;
use App\Repositories\Interfaces\TelephoneRepositoryInterface;
use App\Services\Provider\Interfaces\DeleteProviderServiceInterface;
use App\Support\Permissions\ValidationPermission;
use App\Support\Enums\PermissionEnum;

class DeleteProviderService extends ValidationPermission implements DeleteProviderServiceInterface
{
    private AddressRepositoryInterface   $addressRepository;
    private TelephoneRepositoryInterface $telephoneRepository;
    private ImageRepositoryInterface     $imageRepository;
    private ProductRepositoryInterface   $productRepository;
    private ProviderRepositoryInterface  $providerRepository;

    public function __construct
    (
        AddressRepositoryInterface   $addressRepository,
        TelephoneRepositoryInterface $telephoneRepository,
        ImageRepositoryInterface     $imageRepository,
        ProductRepositoryInterface   $productRepository,
        ProviderRepositoryInterface  $providerRepository
    )
    {
        $this->addressRepository              = $addressRepository;
        $this->telephoneRepository            = $telephoneRepository;
        $this->imageRepository                = $imageRepository;
        $this->productRepository              = $productRepository;
        $this->providerRepository             = $providerRepository;
    }

    public function deleteProvider(int $id, bool $active): bool
    {
        $this->validationPermission(PermissionEnum::HABILITAR_DESABILITAR_FORNECEDOR);
        if
        (
            $this->addressRepository->enableDisable($id, $active) and
            $this->telephoneRepository->enableDisable($id, $active) and
            $this->produtos($id, $active) and
            $this->providerRepository->enableDisable($id, $active)
        ):
            return true;
        else:
            return false;
        endif;
    }

    public function produtos(int $id, bool $active): bool
    {
        $produtos = $this->providerRepository->getProdutosByProvider($id);
        foreach($produtos as $produto):
            $this->imageRepository->enableDisable($produto['id'], $active);
            $this->productRepository->enableDisable($produto['id'], $active);
        endforeach;
        return true;
    }
}
