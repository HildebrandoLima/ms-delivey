<?php

namespace App\Services\Telephone;

use App\DataTransferObjects\RequestsDtos\TelephoneRequestDto;
use App\Http\Requests\TelephoneRequest;
use App\Repositories\CheckRegisterRepository;
use App\Repositories\Interfaces\TelephoneRepositoryInterface;
use App\Services\Telephone\Interfaces\ICreateTelephoneService;

class CreateTelephoneService implements ICreateTelephoneService
{
    private CheckRegisterRepository $checkRegisterRepository;
    private TelephoneRepositoryInterface $telephoneRepositoryInterface;

    public function __construct
    (
        CheckRegisterRepository      $checkRegisterRepository,
        TelephoneRepositoryInterface $telephoneRepositoryInterface,
    )
    {
        $this->checkRegisterRepository      = $checkRegisterRepository;
        $this->telephoneRepositoryInterface = $telephoneRepositoryInterface;
    }

    public function createTelephone(TelephoneRequest $request): int
    {
        foreach ($request->telefones as $telefone):
            $this->checkRegisterRepository->checkTelephoneExist($telefone['numero']);
            $telephone = TelephoneRequestDto::fromRquest($telefone);
            $this->telephoneRepositoryInterface->create($telephone);
        endforeach;
        return true;
    }
}
