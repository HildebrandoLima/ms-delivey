<?php

namespace App\Services\Telephone\Concretes;

use App\DataTransferObjects\RequestsDtos\TelephoneRequestDto;
use App\Http\Requests\TelephoneRequest;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Repositories\Interfaces\TelephoneRepositoryInterface;
use App\Services\Telephone\Interfaces\CreateTelephoneServiceInterface;
use App\Support\Permissions\ValidationPermission;
use App\Support\Utils\Enums\PermissionEnum;

class CreateTelephoneService extends ValidationPermission implements CreateTelephoneServiceInterface
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

    public function createTelephone(TelephoneRequest $request): int
    {
        $this->validationPermission(PermissionEnum::CRIAR_TELEFONE);
        foreach ($request->telefones as $telefone):
            $this->checkEntityRepository->checkTelephoneExist($telefone['numero']);
            $telephone = TelephoneRequestDto::fromRquest($telefone);
            $this->telephoneRepository->create($telephone);
        endforeach;
        return true;
    }
}
