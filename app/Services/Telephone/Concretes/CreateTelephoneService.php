<?php

namespace App\Services\Telephone\Concretes;

use App\Http\Requests\Telephone\CreateTelephoneRequest;
use App\Models\Telefone;
use App\Repositories\Interfaces\TelephoneRepositoryInterface;
use App\Services\Telephone\Interfaces\CreateTelephoneServiceInterface;
use App\Support\Cases\TelephoneCase;
use App\Support\Enums\TelephoneEnum;

class CreateTelephoneService implements CreateTelephoneServiceInterface
{
    private TelephoneRepositoryInterface $telephoneRepository;

    public function __construct(TelephoneRepositoryInterface $telephoneRepository)
    {
        $this->telephoneRepository = $telephoneRepository;
    }

    public function createTelephone(CreateTelephoneRequest $request): bool
    {
        foreach ($request->telefones as $telefone):
            $telephone = $this->map($telefone);
            $this->telephoneRepository->create($telephone);
        endforeach;
        return true;
    }

    private function map(array $telefone): Telefone
    {
        $telephone = new Telefone();
        $telephone->numero = $telefone['numero'];
        $telephone->tipo = TelephoneCase::typeCase($telefone['tipo']);
        $telephone->ddd_id = $telefone['dddId'];
        $telephone->usuario_id = $telefone['usuarioId'] ?? null;
        $telephone->fornecedor_id = $telefone['fornecedorId'] ?? null;
        $telephone->ativo = TelephoneEnum::ATIVADO;
        return $telephone;
    }
}
