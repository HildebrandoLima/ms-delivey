<?php

namespace App\Services\Telephone\Concretes;

use App\DataTransferObjects\RequestsDtos\TelephoneRequestDto;
use App\Http\Requests\TelephoneRequest;
use App\Repositories\Concretes\TelephoneRepository;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Services\Telephone\Interfaces\EditTelephoneServiceInterface;
use App\Support\Permissions\ValidationPermission;
use App\Support\Utils\Enums\PermissionEnum;

class EditTelephoneService extends ValidationPermission implements EditTelephoneServiceInterface
{
    private CheckEntityRepositoryInterface $checkEntityRepository;
    private TelephoneRepository            $telephoneRepository;

    public function __construct
    (
        CheckEntityRepositoryInterface $checkEntityRepository,
        TelephoneRepository            $telephoneRepository
    )
    {
        $this->checkEntityRepository = $checkEntityRepository;
        $this->telephoneRepository   = $telephoneRepository;
    }

    public function editTelephone(int $id, TelephoneRequest $request): bool
    {
        $this->validationPermission(PermissionEnum::EDITAR_TELEFONE);
        foreach ($request->telefones as $telefone):
            $this->checkEntityRepository->checkTelephoneIdExist($id);
            $telephone = TelephoneRequestDto::fromRquest($telefone);
            $this->telephoneRepository->update($id, $telephone);
        endforeach;
        return true;
    }
}
