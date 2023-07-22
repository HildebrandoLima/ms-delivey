<?php

namespace App\Services\Provider\Concretes;

use App\Repositories\Concretes\AddressRepository;
use App\Repositories\Concretes\ImageRepository;
use App\Repositories\Concretes\ProductRepository;
use App\Repositories\Concretes\ProviderRepository;
use App\Repositories\Concretes\TelephoneRepository;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Services\Provider\Interfaces\DeleteProviderServiceInterface;
use App\Support\Permissions\ValidationPermission;
use App\Support\Enums\PermissionEnum;

class DeleteProviderService extends ValidationPermission implements DeleteProviderServiceInterface
{
    private CheckEntityRepositoryInterface $checkEntityRepository;
    private AddressRepository              $addressRepository;
    private TelephoneRepository            $telephoneRepository;
    private ImageRepository                $imageRepository;
    private ProductRepository              $productRepository;
    private ProviderRepository             $providerRepository;

    public function __construct
    (
        CheckEntityRepositoryInterface $checkEntityRepository,
        AddressRepository              $addressRepository,
        TelephoneRepository            $telephoneRepository,
        ImageRepository                $imageRepository,
        ProductRepository              $productRepository,
        ProviderRepository             $providerRepository
    )
    {
        $this->checkEntityRepository = $checkEntityRepository;
        $this->addressRepository              = $addressRepository;
        $this->telephoneRepository            = $telephoneRepository;
        $this->imageRepository                = $imageRepository;
        $this->productRepository              = $productRepository;
        $this->providerRepository             = $providerRepository;
    }

    public function deleteProvider(int $id, int $active): bool
    {
        $this->validationPermission(PermissionEnum::HABILITAR_DESABILITAR_FORNECEDOR);
        $this->checkEntityRepository->checkProviderIdExist($id);
        $this->checkEntityRepository->checkAddressIdExist($id);
        $this->checkEntityRepository->checkTelephoneIdExist($id);
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

    public function produtos(int $id, int $active): bool
    {
        $produtos = $this->checkEntityRepository->getProdutos($id);
        foreach($produtos as $produto):
            $this->imageRepository->enableDisable($produto['id'], $active);
            $this->productRepository->enableDisable($produto['id'], $active);
        endforeach;
        return true;
    }
}
