<?php

namespace App\Services\Telephone\Concretes;

use App\DataTransferObjects\RequestsDtos\TelephoneRequestDto;
use App\Http\Requests\TelephoneRequest;
use App\Repositories\Concretes\TelephoneRepository;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Services\Telephone\Interfaces\EditTelephoneServiceInterface;

class EditTelephoneService implements EditTelephoneServiceInterface
{
    private CheckEntityRepositoryInterface $checkEntityRepositoryInterface;
    private TelephoneRepository            $telephoneRepository;

    public function __construct
    (
        CheckEntityRepositoryInterface $checkEntityRepositoryInterface,
        TelephoneRepository            $telephoneRepository
    )
    {
        $this->checkEntityRepositoryInterface = $checkEntityRepositoryInterface;
        $this->telephoneRepository            = $telephoneRepository;
    }

    public function editTelephone(int $id, TelephoneRequest $request): bool
    {
        foreach ($request->telefones as $telefone):
            $this->checkEntityRepositoryInterface->checkTelephoneIdExist($id);
            $telephone = TelephoneRequestDto::fromRquest($telefone);
            $this->telephoneRepository->update($id, $telephone);
        endforeach;
        return true;
    }
}
