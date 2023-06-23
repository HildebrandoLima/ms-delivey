<?php

namespace App\Services\Telephone\Concretes;

use App\DataTransferObjects\RequestsDtos\TelephoneRequestDto;
use App\Http\Requests\TelephoneRequest;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Repositories\Interfaces\TelephoneRepositoryInterface;
use App\Services\Telephone\Interfaces\CreateTelephoneServiceInterface;

class CreateTelephoneService implements CreateTelephoneServiceInterface
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
        foreach ($request->telefones as $telefone):
            $this->checkEntityRepository->checkTelephoneExist($telefone['numero']);
            $telephone = TelephoneRequestDto::fromRquest($telefone);
            $this->telephoneRepository->create($telephone);
        endforeach;
        return true;
    }
}
