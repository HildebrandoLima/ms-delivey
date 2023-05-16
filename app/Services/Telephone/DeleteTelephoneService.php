<?php

namespace App\Services\Telephone;

use App\Exceptions\HttpBadRequest;
use App\Models\Telefone;
use App\Repositories\TelephoneRepository;
use App\Services\Telephone\Interfaces\IDeleteTelephoneService;

class DeleteTelephoneService implements IDeleteTelephoneService
{
    private TelephoneRepository $telephoneRepository;

    public function __construct(TelephoneRepository $telephoneRepository)
    {
        $this->telephoneRepository = $telephoneRepository;
    }

    public function deleteTelephone(int $id): bool
    {
        $this->checkTelephone($id);
        return $this->telephoneRepository->delete($id);
    }

    private function checkTelephone(int $id): void
    {
        if (Telefone::query()->where('id', $id)->count() == 0):
            throw new HttpBadRequest('O telefone não existe');
        endif;
    }
}
