<?php

namespace App\Services\Telephone;

use App\Http\Requests\TelephoneRequest;
use App\Repositories\TelephoneRepository;
use App\Services\Telephone\Interfaces\ICreateTelephoneService;
use App\Support\Utils\CheckRegister\CheckProvider;
use App\Support\Utils\CheckRegister\CheckTelephone;
use App\Support\Utils\CheckRegister\CheckUser;
use App\Support\Utils\MapToModel\TelephoneModel;

class CreateTelephoneService implements ICreateTelephoneService
{
    private CheckUser $checkUser;
    private CheckProvider $checkProvider;
    private CheckTelephone $checkTelephone;
    private TelephoneModel $telephoneModel;
    private TelephoneRepository $telephoneRepository;

    public function __construct
    (
        CheckUser           $checkUser,
        CheckProvider       $checkProvider,
        CheckTelephone      $checkTelephone,
        TelephoneModel      $telephoneModel,
        TelephoneRepository $telephoneRepository
    )
    {
        $this->checkUser           = $checkUser;
        $this->checkProvider       = $checkProvider;
        $this->checkTelephone      = $checkTelephone;
        $this->telephoneModel      = $telephoneModel;
        $this->telephoneRepository = $telephoneRepository;
    }

    public function createTelephone(TelephoneRequest $request): int
    {
        foreach ($request->telefones as $telefone):
            $this->checkTelephone->checkTelephoneExist($telefone['numero']);
            isset ($telefone['usuarioId']) ? $this->checkUser->checkUserIdExist($telefone['usuarioId'])
            : $this->checkProvider->checkProviderIdExist($telefone['fornecedorId']);
            $telephone = $this->telephoneModel->telephoneModel($telefone, 'create');
            $this->telephoneRepository->insert($telephone);
        endforeach;
        return true;
    }
}
