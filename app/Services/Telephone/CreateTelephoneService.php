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
use DateTime;

class CreateTelephoneService implements ICreateTelephoneService
{
    private CheckUser $checkUser;
    private CheckProvider $checkProvider;
    private CheckTelephone $checkTelephone;
    private TelephoneRepository $telephoneRepository;
    private TelephoneCase $telephoneCase;

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
        $this->request = $request->telefones;
        foreach ($this->request as $value):
            isset($value['usuarioId']) ? $this->checkUser->checkUserIdExist($value['usuarioId'])
            : $this->checkProvider->checkProviderIdExist($value['fornecedorId']);
            $this->checkTelephone->checkTelephoneExist($value['numero']);
            $telephone = $this->mapToModel($value);
            $this->telephoneRepository->insert($telephone);
        endforeach;
        return true;
    }

    private function mapToModel(array $value): Telefone
    {
        $telephone = new Telefone();
        $telephone->numero = $value['numero'];
        $telephone->tipo = $this->telephoneCase->typeCase($value['tipo']);
        $telephone->ddd_id = $value['dddId'];
        $telephone->usuario_id = isset($value['usuarioId']) ? $value['usuarioId'] : 1;
        $telephone->fornecedor_id = isset($value['fornecedorId']) ? $value['fornecedorId'] : 1;
        $telephone->created_at = new DateTime();
        return $telephone;
    }
}
