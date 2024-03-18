<?php

namespace App\Domains\Services\Telephone\Concretes;

use App\Data\Repositories\Abstracts\IEntityRepository;
use App\Domains\Services\Telephone\Abstracts\ICreateTelephoneService;
use App\Http\Requests\Telephone\CreateTelephoneRequest;
use App\Models\Telefone;
use App\Support\Enums\AtivoEnum;

class CreateTelephoneService implements ICreateTelephoneService
{
    private IEntityRepository $telephoneRepository;

    public function __construct(IEntityRepository $telephoneRepository)
    {
        $this->telephoneRepository = $telephoneRepository;
    }

    public function createTelephone(CreateTelephoneRequest $request): bool
    {
        foreach ($request->all() as $telefone):
            $telephone = $this->map($telefone);
            $this->telephoneRepository->create($telephone);
        endforeach;
        return true;
    }

    public function map(array $telefone): Telefone
    {
        $telephone = new Telefone();
        $telephone->numero = $telefone['numero'];
        $telephone->tipo = $telefone['tipo'];
        $telephone->usuario_id = $telefone['usuarioId'] ?? null;
        $telephone->fornecedor_id = $telefone['fornecedorId'] ?? null;
        $telephone->ativo = AtivoEnum::ATIVADO;
        return $telephone;
    }
}
