<?php

namespace App\Services\Telephone\Concretes;

use App\DataTransferObjects\RequestsDtos\TelephoneRequestDto;
use App\Http\Requests\TelephoneRequest;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Repositories\Interfaces\TelephoneRepositoryInterface;
use App\Services\Telephone\Interfaces\CreateTelephoneServiceInterface;

class CreateTelephoneService implements CreateTelephoneServiceInterface
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

    public function createTelephone(TelephoneRequest $request): int
    {
        foreach ($request->telefones as $telefone):
            $this->checkEntityRepositoryInterface->checkTelephoneExist($telefone['numero']);
            $telephone = TelephoneRequestDto::fromRquest($telefone);
            $this->telephoneRepositoryInterface->create($telephone);
        endforeach;
        return true;
    }
}
