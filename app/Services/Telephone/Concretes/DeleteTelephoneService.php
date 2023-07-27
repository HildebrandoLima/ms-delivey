<?php

namespace App\Services\Telephone\Concretes;

use App\Repositories\Interfaces\TelephoneRepositoryInterface;
use App\Services\Telephone\Interfaces\DeleteTelephoneServiceInterface;
use App\Support\Permissions\ValidationPermission;
use App\Support\Enums\PermissionEnum;

class DeleteTelephoneService extends ValidationPermission implements DeleteTelephoneServiceInterface
{
    private TelephoneRepositoryInterface   $telephoneRepository;

    public function __construct(TelephoneRepositoryInterface $telephoneRepository)
    {
        $this->telephoneRepository = $telephoneRepository;
    }

    public function deleteTelephone(int $id, bool $active): bool
    {
        $this->validationPermission(PermissionEnum::HABILITAR_DESABILITAR_TELEFONE);
        return $this->telephoneRepository->enableDisable($id, $active);
    }
}
