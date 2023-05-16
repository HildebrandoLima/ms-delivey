<?php

namespace App\Services\Telephone;

use App\Exceptions\HttpBadRequest;
use App\Models\User;
use App\Repositories\TelephoneRepository;
use Illuminate\Support\Collection;

class ListTelephoneService
{
    private TelephoneRepository $telephoneRepository;

    public function __construct(TelephoneRepository $telephoneRepository)
    {
        $this->telephoneRepository = $telephoneRepository;
    }

    public function listDDDAll(): Collection
    {
        return $this->telephoneRepository->getDDDAll();
    }

    public function listTelephoneAll(int $id): Collection
    {
        $this->checkUser($id);
        return $this->telephoneRepository->getTelephoneAll($id);
    }

    private function checkUser(int $id): void
    {
        if (User::query()->where('id', $id)->count() == 0):
            throw new HttpBadRequest('O usuário não existe');
        endif;
    }
}
