<?php

namespace App\Services\Telephone\Concretes;

use App\Repositories\Interfaces\TelephoneRepositoryInterface;
use App\Services\Telephone\Interfaces\DeleteTelephoneServiceInterface;

class DeleteTelephoneService implements DeleteTelephoneServiceInterface
{
    private TelephoneRepositoryInterface   $telephoneRepository;

    public function __construct(TelephoneRepositoryInterface $telephoneRepository)
    {
        $this->telephoneRepository = $telephoneRepository;
    }

    public function deleteTelephone(int $id, bool $active): bool
    {
        return $this->telephoneRepository->enableDisable($id, $active);
    }
}
