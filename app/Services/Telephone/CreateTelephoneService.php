<?php

namespace App\Services\Telephone;

use App\Http\Requests\TelephoneRequest;
use App\Models\Telefone;
use App\Repositories\TelephoneRepository;
use App\Services\Telephone\Interfaces\ICreateTelephoneService;
use App\Support\Utils\Cases\TelephoneCase;
use App\Support\Utils\CheckRegister\CheckProvider;
use App\Support\Utils\CheckRegister\CheckTelephone;
use App\Support\Utils\CheckRegister\CheckUser;

class CreateTelephoneService implements ICreateTelephoneService
{
    private CheckUser $checkUser;
    private CheckProvider $checkProvider;
    private CheckTelephone $checkTelephone;
    private TelephoneCase $telephoneCase;
    private TelephoneRepository $telephoneRepository;

    public function __construct
    (
        CheckUser           $checkUser,
        CheckProvider       $checkProvider,
        CheckTelephone      $checkTelephone,
        TelephoneCase       $telephoneCase,
        TelephoneRepository $telephoneRepository
    )
    {
        $this->checkUser           = $checkUser;
        $this->checkProvider       = $checkProvider;
        $this->checkTelephone      = $checkTelephone;
        $this->telephoneCase       = $telephoneCase;
        $this->telephoneRepository = $telephoneRepository;
    }

    public function createTelephone(TelephoneRequest $request): int
    {
        foreach ($request->telefones as $telefone):
            $this->checkTelephone->checkTelephoneExist($telefone['numero']);
            isset ($telefone['usuarioId']) ? $this->checkUser->checkUserIdExist($telefone['usuarioId'])
            : $this->checkProvider->checkProviderIdExist($telefone['fornecedorId']);
            $telephone = $this->mapToModel($telefone);
            $this->telephoneRepository->insert($telephone);
        endforeach;
        return true;
    }

    private function mapToModel(array $telephones): Telefone
    {
        $telephone = new Telefone();
        $telephone->numero = $telephones['numero'];
        $telephone->tipo = $this->telephoneCase->typeCase($telephones['tipo']);
        $telephone->ddd_id = $telephones['dddId'];
        $telephone->usuario_id = isset ($telephones['usuarioId']) ? $telephones['usuarioId'] : 1;
        $telephone->fornecedor_id = isset ($telephones['fornecedorId']) ? $telephones['fornecedorId'] : 1;
        return $telephone;
    }
}
