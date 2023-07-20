<?php

namespace App\Services\Telephone\Concretes;

use App\Http\Requests\TelephoneRequest;
use App\Models\Telefone;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Repositories\Interfaces\TelephoneRepositoryInterface;
use App\Services\Telephone\Interfaces\EditTelephoneServiceInterface;
use App\Support\Permissions\ValidationPermission;
use App\Support\Cases\TelephoneCase;
use App\Support\Enums\PermissionEnum;
use App\Support\Enums\TelephoneEnum;

class EditTelephoneService extends ValidationPermission implements EditTelephoneServiceInterface
{
    private CheckEntityRepositoryInterface $checkEntityRepository;
    private TelephoneRepositoryInterface   $telephoneRepository;

    public function __construct
    (
        CheckEntityRepositoryInterface $checkEntityRepository,
        TelephoneRepositoryInterface    $telephoneRepository
    )
    {
        $this->checkEntityRepository = $checkEntityRepository;
        $this->telephoneRepository   = $telephoneRepository;
    }

    public function editTelephone(int $id, TelephoneRequest $request): bool
    {
        $this->validationPermission(PermissionEnum::EDITAR_TELEFONE);
        foreach ($request->telefones as $telefone):
            $this->checkEntityRepository->checkTelephoneIdExist($id);
            $telephone = $this->map($telefone);
            $this->telephoneRepository->update($id, $telephone);
        endforeach;
        return true;
    }

    private function map(array $telefone): Telefone
    {
        $telephone = new Telefone();
        $telephone->numero = str_replace('-', "", $telefone['numero']);
        $telephone->tipo = TelephoneCase::typeCase($telefone['tipo']);
        $telephone->ddd_id = $telefone['dddId'];
        $telephone->usuario_id = $telefone['usuarioId'] ?? null;
        $telephone->fornecedor_id = $telefone['fornecedorId'] ?? null;
        $telefone['ativo'] == true ? $telephone->ativo = TelephoneEnum::ATIVADO : $telephone->ativo = TelephoneEnum::DESATIVADO;
        return $telephone;
    }
}
