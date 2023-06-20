<?php

namespace App\Services\Provider;

use App\Repositories\Concretes\AddressRepository;
use App\Repositories\CheckRegisterRepository;
use App\Repositories\ImageRepository;
use App\Repositories\ProductRepository;
use App\Repositories\Concretes\ProviderRepository;
use App\Repositories\Concretes\TelephoneRepository;
use App\Services\Provider\Interfaces\IDeleteProviderService;

class DeleteProviderService implements IDeleteProviderService
{
    private CheckRegisterRepository $checkRegisterRepository;
    private AddressRepository $addressRepository;
    private TelephoneRepository $telephoneRepository;
    private ImageRepository $imageRepository;
    private ProductRepository $productRepository;
    private ProviderRepository $providerRepository;

    public function __construct
    (
        CheckRegisterRepository $checkRegisterRepository,
        AddressRepository       $addressRepository,
        TelephoneRepository     $telephoneRepository,
        ImageRepository         $imageRepository,
        ProductRepository       $productRepository,
        ProviderRepository      $providerRepository
    )
    {
        $this->checkRegisterRepository = $checkRegisterRepository;
        $this->addressRepository       = $addressRepository;
        $this->telephoneRepository     = $telephoneRepository;
        $this->imageRepository         = $imageRepository;
        $this->productRepository       = $productRepository;
        $this->providerRepository      = $providerRepository;
    }

    public function deleteProvider(int $id, int $active): bool
    {
        $this->checkRegisterRepository->checkProviderIdExist($id);
        $this->checkRegisterRepository->checkAddressIdExist($id);
        $this->checkRegisterRepository->checkTelephoneIdExist($id);
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
        $produtos = $this->checkRegisterRepository->getProdutos($id);
        foreach($produtos->toArray() as $produto):
            $this->imageRepository->enableDisable($produto['id'], $active);
            $this->productRepository->enableDisable($produto['id'], $active);
        endforeach;
        return true;
    }
}
