<?php

namespace App\Services\Telephone\Concretes;

use App\Http\Requests\Telephone\EditTelephoneRequest;
use App\Models\Telefone;
use App\Repositories\Abstracts\IEntityRepository;
use App\Services\Telephone\Interfaces\EditTelephoneServiceInterface;

class EditTelephoneService implements EditTelephoneServiceInterface
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

    private function map(EditTelephoneRequest $request): Telefone
    {
        $telephone = new Telefone();
        $telephone->id = $request->id;
        $telephone->numero = $request->numero;
        $telephone->tipo = $request->tipo;
        $telephone->usuario_id = $request->usuarioId ?? null;
        $telephone->fornecedor_id = $request->fornecedorId ?? null;
        return $telephone;
    }
}
