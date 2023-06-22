<?php

namespace App\Services\Provider\Concretes;

use App\Repositories\Concretes\AddressRepository;
use App\Repositories\Concretes\ImageRepository;
use App\Repositories\Concretes\ProductRepository;
use App\Repositories\Concretes\ProviderRepository;
use App\Repositories\Concretes\TelephoneRepository;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Services\Provider\Interfaces\DeleteProviderServiceInterface;

class DeleteProviderService implements DeleteProviderServiceInterface
{
    private CheckEntityRepositoryInterface $checkEntityRepositoryInterface;
    private AddressRepository              $addressRepository;
    private TelephoneRepository            $telephoneRepository;
    private ImageRepository                $imageRepository;
    private ProductRepository              $productRepository;
    private ProviderRepository             $providerRepository;

    public function __construct
    (
        CheckEntityRepositoryInterface $checkEntityRepositoryInterface,
        AddressRepository              $addressRepository,
        TelephoneRepository            $telephoneRepository,
        ImageRepository                $imageRepository,
        ProductRepository              $productRepository,
        ProviderRepository             $providerRepository
    )
    {
        $this->checkEntityRepositoryInterface = $checkEntityRepositoryInterface;
        $this->addressRepository              = $addressRepository;
        $this->telephoneRepository            = $telephoneRepository;
        $this->imageRepository                = $imageRepository;
        $this->productRepository              = $productRepository;
        $this->providerRepository             = $providerRepository;
    }

    public function deleteProvider(int $id, int $active): bool
    {
        $this->checkEntityRepositoryInterface->checkProviderIdExist($id);
        $this->checkEntityRepositoryInterface->checkAddressIdExist($id);
        $this->checkEntityRepositoryInterface->checkTelephoneIdExist($id);
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
        $produtos = $this->checkEntityRepositoryInterface->getProdutos($id);
        foreach($produtos as $produto):
            $this->imageRepository->enableDisable($produto['id'], $active);
            $this->productRepository->enableDisable($produto['id'], $active);
        endforeach;
        return true;
    }
}
