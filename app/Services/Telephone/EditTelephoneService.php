<?php

namespace App\Services\Telephone;

use App\Http\Requests\TelephoneRequest;
use App\Models\Telefone;
use App\Repositories\TelephoneRepository;
use App\Services\Telephone\Interfaces\IEditTelephoneService;
use App\Support\Utils\Cases\TelephoneCase;
use App\Support\Utils\CheckRegister\CheckTelephone;
use DateTime;

class EditTelephoneService implements IEditTelephoneService
{
    private CheckTelephone $checkTelephone;
    private TelephoneCase $telephoneCase;
    private TelephoneRepository $telephoneRepository;

    public function __construct
    (
        CheckTelephone      $checkTelephone,
        TelephoneCase       $telephoneCase,
        TelephoneRepository $telephoneRepository
    )
    {
        $this->checkTelephone      = $checkTelephone;
        $this->telephoneCase       = $telephoneCase;
        $this->telephoneRepository = $telephoneRepository;
    }

    public function editTelephone(int $id, TelephoneRequest $request): bool
    {
        $this->request = $request->telefones;
        foreach ($this->request as $value):
            $this->checkTelephone->checkTelephoneIdExist($id);
            $telephone = $this->mapToModel($value);
            $this->telephoneRepository->update($id, $telephone);
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
        $telephone->updated_at = new DateTime();
        return $telephone;
    }
}
