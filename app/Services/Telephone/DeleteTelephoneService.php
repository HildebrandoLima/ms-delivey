<?php

namespace App\Services\Telephone;

use App\Repositories\CheckRegisterRepository;
use App\Repositories\TelephoneRepository;
use App\Services\Telephone\Interfaces\IDeleteTelephoneService;

class DeleteTelephoneService implements IDeleteTelephoneService
{
    private CheckRegisterRepository $checkRegisterRepository;
    private TelephoneRepository $telephoneRepository;

    public function __construct
    (
        CheckRegisterRepository $checkRegisterRepository,
        TelephoneRepository     $telephoneRepository
    )
    {
        $this->checkRegisterRepository = $checkRegisterRepository;
        $this->telephoneRepository     = $telephoneRepository;
    }

    public function deleteTelephone(int $id): bool
    {
        $this->checkRegisterRepository->checkTelephoneIdExist($id);
        return $this->telephoneRepository->delete($id);
    }
}
