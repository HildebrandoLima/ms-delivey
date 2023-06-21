<?php

namespace App\Services\Telephone;

use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Repositories\Interfaces\TelephoneRepositoryInterface;
use App\Services\Telephone\Interfaces\IDeleteTelephoneService;

class DeleteTelephoneService implements IDeleteTelephoneService
{
    private CheckEntityRepositoryInterface $checkEntityRepositoryInterface;
    private TelephoneRepositoryInterface   $telephoneRepositoryInterface;

    public function __construct
    (
        CheckEntityRepositoryInterface $checkEntityRepositoryInterface,
        TelephoneRepositoryInterface   $telephoneRepositoryInterface,
    )
    {
        $this->checkEntityRepositoryInterface = $checkEntityRepositoryInterface;
        $this->telephoneRepositoryInterface   = $telephoneRepositoryInterface;
    }

    public function deleteTelephone(int $id, int $active): bool
    {
        $this->checkEntityRepositoryInterface->checkTelephoneIdExist($id);
        return $this->telephoneRepositoryInterface->enableDisable($id, $active);
    }
}
