<?php

namespace App\Services\Telephone;

use App\Repositories\TelephoneRepository;
use App\Services\Telephone\Interfaces\IListTelephoneService;
use App\Support\Utils\CheckRegister\CheckUser;
use Illuminate\Support\Collection;

class ListTelephoneService implements IListTelephoneService
{
    private CheckUser $checkUser;
    private TelephoneRepository $telephoneRepository;

    public function __construct
    (
        CheckUser           $checkUser,
        TelephoneRepository $telephoneRepository
    )
    {
        $this->checkUser           = $checkUser;
        $this->telephoneRepository = $telephoneRepository;
    }

    public function listDDDAll(): Collection
    {
        return $this->telephoneRepository->getDDDAll();
    }

    public function listTelephoneAll(int $id): Collection
    {
        $this->checkUser->checkUserIdExist($id);
        return $this->telephoneRepository->getTelephoneAll($id);
    }
}
