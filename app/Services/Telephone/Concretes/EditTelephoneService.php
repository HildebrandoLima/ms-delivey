<?php

namespace App\Services\Telephone\Concretes;

use App\Http\Requests\Telephone\EditTelephoneRequest;
use App\Models\Telefone;
use App\Repositories\Interfaces\TelephoneRepositoryInterface;
use App\Services\Telephone\Interfaces\EditTelephoneServiceInterface;
use App\Support\Cases\TelephoneCase;
use App\Support\Enums\TelephoneEnum;

class EditTelephoneService implements EditTelephoneServiceInterface
{
    private TelephoneRepositoryInterface $telephoneRepository;

    public function __construct(TelephoneRepositoryInterface $telephoneRepository)
    {
        $this->telephoneRepository = $telephoneRepository;
    }

    public function editTelephone(EditTelephoneRequest $request): bool
    {
        $telephone = $this->map($request);
        $this->telephoneRepository->update($telephone);
        return true;
    }

    private function map(EditTelephoneRequest $request): Telefone
    {
        $telephone = new Telefone();
        $telephone->id = $request->id;
        $telephone->numero = $request->numero;
        $telephone->tipo = TelephoneCase::typeCase($request->tipo);
        $telephone->ddd_id = $request->dddId;
        $telephone->usuario_id = $request->usuarioId ?? null;
        $telephone->fornecedor_id = $request->fornecedorId ?? null;
        $telephone->ativo = $request->ativo == true ? TelephoneEnum::ATIVADO : TelephoneEnum::DESATIVADO;
        return $telephone;
    }
}
