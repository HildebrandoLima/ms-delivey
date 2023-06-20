<?php

namespace App\Services\Telephone;

use App\Http\Requests\TelephoneRequest;
use App\Models\Telefone;
use App\Repositories\CheckRegisterRepository;
use App\Repositories\Concretes\TelephoneRepository;
use App\Services\Telephone\Interfaces\IEditTelephoneService;
use App\Support\Utils\Cases\TelephoneCase;
use App\Support\Utils\Enums\TelephoneEnum;

class EditTelephoneService implements IEditTelephoneService
{
    private TelephoneCase $telephoneCase;
    private CheckRegisterRepository $checkRegisterRepository;
    private TelephoneRepository $telephoneRepository;

    public function __construct
    (
        TelephoneCase           $telephoneCase,
        CheckRegisterRepository $checkRegisterRepository,
        TelephoneRepository     $telephoneRepository
    )
    {
        $this->telephoneCase           = $telephoneCase;
        $this->checkRegisterRepository = $checkRegisterRepository;
        $this->telephoneRepository     = $telephoneRepository;
    }

    public function editTelephone(int $id, TelephoneRequest $request): bool
    {
        foreach ($request->telefones as $telefone):
            $this->checkRegisterRepository->checkTelephoneIdExist($id);
            $telephone = $this->mapToModel($telefone);
            $this->telephoneRepository->update($id, $telephone);
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
        $telephones['ativo'] == 1 ? $telephone->ativo = TelephoneEnum::ATIVADO : $telephone->ativo = TelephoneEnum::DESATIVADO;
        return $telephone;
    }
}
