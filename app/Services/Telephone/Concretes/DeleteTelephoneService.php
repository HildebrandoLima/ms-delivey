<?php

namespace App\Services\Telephone\Concretes;

use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Repositories\Interfaces\TelephoneRepositoryInterface;
use App\Services\Telephone\Interfaces\DeleteTelephoneServiceInterface;

class DeleteTelephoneService implements DeleteTelephoneServiceInterface
{
    private CheckEntityRepositoryInterface $checkEntityRepository;
    private TelephoneRepositoryInterface   $telephoneRepository;

    public function __construct
    (
        CheckEntityRepositoryInterface $checkEntityRepository,
        TelephoneRepositoryInterface   $telephoneRepository,
    )
    {
        $this->checkEntityRepository = $checkEntityRepository;
        $this->telephoneRepository   = $telephoneRepository;
    }

    public function deleteTelephone(int $id, int $active): bool
    {
        $this->checkEntityRepository->checkTelephoneIdExist($id);
        return $this->telephoneRepository->enableDisable($id, $active);
    }
}
