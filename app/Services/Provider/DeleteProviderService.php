<?php

namespace App\Services\Provider;

use App\Repositories\AddressRepository;
use App\Repositories\CheckRegisterRepository;
use App\Repositories\ProviderRepository;
use App\Repositories\TelephoneRepository;
use App\Services\Provider\Interfaces\IDeleteProviderService;

class DeleteProviderService implements IDeleteProviderService
{
    private CheckRegisterRepository $checkRegisterRepository;
    private AddressRepository $addressRepository;
    private TelephoneRepository $telephoneRepository;
    private ProviderRepository $providerRepository;

    public function __construct
    (
        CheckRegisterRepository $checkRegisterRepository,
        AddressRepository       $addressRepository,
        TelephoneRepository     $telephoneRepository,
        ProviderRepository      $providerRepository
    )
    {
        $this->checkRegisterRepository = $checkRegisterRepository;
        $this->addressRepository       = $addressRepository;
        $this->telephoneRepository     = $telephoneRepository;
        $this->providerRepository      = $providerRepository;
    }

    public function deleteProvider(int $id): bool
    {
        $this->checkRegisterRepository->checkProviderIdExist($id);
        $this->checkRegisterRepository->checkAddressIdExist($id);
        $this->checkRegisterRepository->checkTelephoneIdExist($id);
        if
        (
            $this->addressRepository->delete($id)
            and $this->telephoneRepository->delete($id)
            and $this->providerRepository->delete($id)
        ):
            return true;
        else:
            return false;
        endif;
    }
}
