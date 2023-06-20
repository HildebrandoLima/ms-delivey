<?php

namespace App\Services\Telephone;

use App\Repositories\CheckRegisterRepository;
use App\Repositories\Interfaces\TelephoneRepositoryInterface;
use App\Services\Telephone\Interfaces\IDeleteTelephoneService;

class DeleteTelephoneService implements IDeleteTelephoneService
{
    private CheckRegisterRepository      $checkRegisterRepository;
    private TelephoneRepositoryInterface $telephoneRepositoryInterface;

    public function __construct
    (
        CheckRegisterRepository      $checkRegisterRepository,
        TelephoneRepositoryInterface $telephoneRepositoryInterface,
    )
    {
        $this->checkRegisterRepository      = $checkRegisterRepository;
        $this->telephoneRepositoryInterface = $telephoneRepositoryInterface;
    }

    public function deleteTelephone(int $id, int $active): bool
    {
        $this->checkRegisterRepository->checkTelephoneIdExist($id);
        return $this->telephoneRepositoryInterface->enableDisable($id, $active);
    }
}
