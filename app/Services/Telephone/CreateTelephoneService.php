<?php

namespace App\Services\Telephone;

use App\Exceptions\HttpBadRequest;
use App\Http\Requests\TelephoneRequest;
use App\Models\Telefone;
use App\Repositories\TelephoneRepository;
use App\Support\Utils\Cases\TelephoneCase;
use DateTime;

class CreateTelephoneService
{
    private TelephoneRepository $telephoneRepository;
    private TelephoneCase $telephoneCase;

    public function __construct(TelephoneRepository $telephoneRepository, TelephoneCase $telephoneCase)
    {
        $this->telephoneRepository = $telephoneRepository;
        $this->telephoneCase = $telephoneCase;
    }

    public function createTelephone(TelephoneRequest $request): int
    {
        $this->request = $request->telefones;
        foreach ($this->request as $value):
            $this->checkTelephone($value['numero']);
            $telephone = $this->mapToModel($value);
            $this->telephoneRepository->insert($telephone);
        endforeach;
        return true;
    }

    private function checkTelephone(string $numero): void
    {
        if (!Telefone::query()->where('numero', 'like', $numero)->count() == 0):
            throw new HttpBadRequest('O número já existe', (int)$numero);
        endif;
    }

    private function mapToModel(array $value): Telefone
    {
        $telephone = new Telefone();
        $telephone->numero = $value['numero'];
        $telephone->tipo = $this->telephoneCase->typeCase($value['tipo']);
        $telephone->ddd_id = $value['dddId'];
        $telephone->usuario_id = isset($value['usuarioId']) ? $value['usuarioId'] : null;
        $telephone->fornecedor_id = isset($value['fornecedorId']) ? $value['fornecedorId'] : null;
        $telephone->created_at = new DateTime();
        return $telephone;
    }
}
