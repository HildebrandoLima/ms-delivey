<?php

namespace App\Services\Telephone;

use App\Http\Requests\TelephoneRequest;
use App\Models\Telefone;
use App\Repositories\TelephoneRepository;
use App\Support\Utils\Cases\TelephoneCase;
use DateTime;

class EditTelephoneService
{
    private TelephoneRepository $telephoneRepository;
    private TelephoneCase $telephoneCase;

    public function __construct(TelephoneRepository $telephoneRepository, TelephoneCase $telephoneCase)
    {
        $this->telephoneRepository = $telephoneRepository;
        $this->telephoneCase = $telephoneCase;
    }

    public function editTelephone(int $id, TelephoneRequest $request): bool
    {
        $this->request = $request->telefones;
        foreach ($this->request as $value):
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
