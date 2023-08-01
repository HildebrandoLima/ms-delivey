<?php

namespace App\Services\Telephone\Concretes;

use App\Http\Requests\Telephone\EditTelephoneRequest;
use App\Models\Telefone;
use App\Repositories\Interfaces\TelephoneRepositoryInterface;
use App\Services\Telephone\Interfaces\EditTelephoneServiceInterface;
use App\Support\Enums\AtivoEnum;

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
        $telephone->tipo = $request->tipo;
        $telephone->usuario_id = $request->usuarioId ?? null;
        $telephone->fornecedor_id = $request->fornecedorId ?? null;
        $telephone->ativo = $request->ativo == true ? AtivoEnum::ATIVADO : AtivoEnum::DESATIVADO;
        return $telephone;
    }
}
