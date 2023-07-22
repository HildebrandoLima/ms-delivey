<?php

namespace App\Services\Telephone\Concretes;

use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Repositories\Interfaces\TelephoneRepositoryInterface;
use App\Services\Telephone\Interfaces\DeleteTelephoneServiceInterface;
use App\Support\Permissions\ValidationPermission;
use App\Support\Enums\PermissionEnum;

class DeleteTelephoneService extends ValidationPermission implements DeleteTelephoneServiceInterface
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
        $this->validationPermission(PermissionEnum::HABILITAR_DESABILITAR_TELEFONE);
        $this->checkEntityRepository->checkTelephoneIdExist($id);
        return $this->telephoneRepository->enableDisable($id, $active);
    }
}
