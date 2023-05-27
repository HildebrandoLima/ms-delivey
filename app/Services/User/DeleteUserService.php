<?php

namespace App\Services\User;

use App\Repositories\AddressRepository;
use App\Repositories\CheckRegisterRepository;
use App\Repositories\TelephoneRepository;
use App\Repositories\UserRepository;
use App\Services\User\Interfaces\IDeleteUserService;

class DeleteUserService implements IDeleteUserService
{
    private CheckRegisterRepository $checkRegisterRepository;
    private AddressRepository $addressRepository;
    private TelephoneRepository $telephoneRepository;
    private UserRepository $userRepository;

    public function __construct
    (
        CheckRegisterRepository $checkRegisterRepository,
        AddressRepository       $addressRepository,
        TelephoneRepository     $telephoneRepository,
        UserRepository          $userRepository
    )
    {
        $this->checkRegisterRepository = $checkRegisterRepository;
        $this->addressRepository       = $addressRepository;
        $this->telephoneRepository     = $telephoneRepository;
        $this->userRepository          = $userRepository;
    }

    public function deleteUser(int $id): bool
    {
        $this->checkRegisterRepository->checkUserIdExist($id);
        $this->checkRegisterRepository->checkAddressIdExist($id);
        $this->checkRegisterRepository->checkTelephoneIdExist($id);
        if
        (
            $this->addressRepository->delete($id)
            and $this->telephoneRepository->delete($id)
            and $this->userRepository->delete($id)
        ):
            return true;
        else:
            return false;
        endif;
    }
}
