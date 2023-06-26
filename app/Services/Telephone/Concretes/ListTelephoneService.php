<?php

namespace App\Services\Telephone\Concretes;

use App\Repositories\Interfaces\TelephoneRepositoryInterface;
use App\Services\Telephone\Interfaces\ListTelephoneServiceInterface;
use App\Support\Permissions\ValidationPermission;
use App\Support\Utils\Enums\PermissionEnum;
use Illuminate\Support\Collection;

class ListTelephoneService extends ValidationPermission implements ListTelephoneServiceInterface
{
    private TelephoneRepositoryInterface $telephoneRepository;

    public function __construct(TelephoneRepositoryInterface $telephoneRepository)
    {
        $this->telephoneRepository = $telephoneRepository;
    }

    public function listDDDAll(): Collection
    {
        $this->validationPermission(PermissionEnum::LISTAR_DDD);
        return $this->telephoneRepository->getDDDAll();
    }
}
