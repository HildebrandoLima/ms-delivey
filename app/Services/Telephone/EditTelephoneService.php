<?php

namespace App\Services\Telephone;

use App\Http\Requests\TelephoneRequest;
use App\Models\Telefone;
use App\Repositories\CheckRegisterRepository;
use App\Repositories\TelephoneRepository;
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
            isset ($telefone['usuarioId']) ? $this->checkRegisterRepository->checkUserIdExist($telefone['usuarioId'])
            : $this->checkRegisterRepository->checkProviderIdExist($telefone['fornecedorId']);
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
        $telephone->usuario_id = isset ($telephones['usuarioId']) ? $telephones['usuarioId'] : 1;
        $telephone->fornecedor_id = isset ($telephones['fornecedorId']) ? $telephones['fornecedorId'] : 1;
        $telephones['ativo'] == 1 ? $telephone->ativo = TelephoneEnum::ATIVADO : $telephone->ativo = TelephoneEnum::DESATIVADO;
        return $telephone;
    }
}
