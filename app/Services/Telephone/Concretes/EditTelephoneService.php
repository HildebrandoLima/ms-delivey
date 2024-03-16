<?php

namespace App\Services\Telephone\Concretes;

use App\Data\Repositories\Abstracts\IEntityRepository;
use App\Http\Requests\Telephone\EditTelephoneRequest;
use App\Models\Telefone;
use App\Services\Telephone\Abstracts\IEditTelephoneService;
use App\Support\Enums\AtivoEnum;

class EditTelephoneService implements IEditTelephoneService
{
    private IEntityRepository $telephoneRepository;

    public function __construct(IEntityRepository $telephoneRepository)
    {
        $this->telephoneRepository = $telephoneRepository;
    }

    public function editTelephone(EditTelephoneRequest $request): bool
    {
        $telephone = $this->map($request);
        $this->telephoneRepository->update($telephone);
        return true;
    }

    public function map(EditTelephoneRequest $request): Telefone
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
