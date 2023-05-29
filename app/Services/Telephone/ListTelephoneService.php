<?php

namespace App\Services\Telephone;

use App\Repositories\CheckRegisterRepository;
use App\Repositories\TelephoneRepository;
use App\Services\Telephone\Interfaces\IListTelephoneService;
use Illuminate\Support\Collection;

class ListTelephoneService implements IListTelephoneService
{
    private CheckRegisterRepository $checkRegisterRepository;
    private TelephoneRepository $telephoneRepository;

    public function __construct
    (
        CheckRegisterRepository $checkRegisterRepository,
        TelephoneRepository     $telephoneRepository
    )
    {
        $this->checkRegisterRepository = $checkRegisterRepository;
        $this->telephoneRepository     = $telephoneRepository;
    }

    public function listDDDAll(): Collection
    {
        return $this->telephoneRepository->getDDDAll();
    }

    public function listTelephoneAll(int $id, int $active): Collection
    {
        $this->checkRegisterRepository->checkUserIdExist($id);
        return $this->telephoneRepository->getTelephoneAll($id, $active);
    }
}
