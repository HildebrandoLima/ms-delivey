<?php

namespace App\Services\Telephone;

use App\Http\Requests\TelephoneRequest;
use App\Models\Telefone;
use App\Repositories\CheckRegisterRepository;
use App\Repositories\TelephoneRepository;
use App\Services\Telephone\Interfaces\ICreateTelephoneService;
use App\Support\Utils\Cases\TelephoneCase;
use App\Support\Utils\Enums\TelephoneEnum;

class CreateTelephoneService implements ICreateTelephoneService
{
    private CheckRegisterRepository $checkRegisterRepository;
    private TelephoneCase $telephoneCase;
    private TelephoneRepository $telephoneRepository;

    public function __construct
    (
        CheckRegisterRepository $checkRegisterRepository,
        TelephoneCase           $telephoneCase,
        TelephoneRepository     $telephoneRepository
    )
    {
        $this->checkRegisterRepository = $checkRegisterRepository;
        $this->telephoneCase           = $telephoneCase;
        $this->telephoneRepository     = $telephoneRepository;
    }

    public function createTelephone(TelephoneRequest $request): int
    {
        foreach ($request->telefones as $telefone):
            $this->checkRegisterRepository->checkTelephoneExist($telefone['numero']);
            $telephone = $this->mapToModel($telefone);
            $this->telephoneRepository->create($telephone);
        endforeach;
        return true;
    }

    private function mapToModel(array $telephones): Telefone
    {
        $telephone = new Telefone();
        $telephone->numero = str_replace('-', "", $telephones['numero']);
        $telephone->tipo = $this->telephoneCase->typeCase($telephones['tipo']);
        $telephone->ddd_id = $telephones['dddId'];
        $telephone->usuario_id = $telephones['usuarioId'] ?? null;
        $telephone->fornecedor_id = $telephones['fornecedorId'] ?? null;
        $telephone->ativo = TelephoneEnum::ATIVADO;
        return $telephone;
    }
}
