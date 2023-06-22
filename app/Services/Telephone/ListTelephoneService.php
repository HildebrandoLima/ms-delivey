<?php

namespace App\Services\Telephone;

use App\Repositories\Interfaces\TelephoneRepositoryInterface;
use App\Services\Telephone\Interfaces\IListTelephoneService;
use Illuminate\Support\Collection;

class ListTelephoneService implements IListTelephoneService
{
    private TelephoneRepositoryInterface $telephoneRepositoryInterface;

    public function __construct(TelephoneRepositoryInterface $telephoneRepositoryInterface)
    {
        $this->telephoneRepositoryInterface = $telephoneRepositoryInterface;
    }

    public function listDDDAll(): Collection
    {
        return $this->telephoneRepositoryInterface->getDDDAll();
    }
}
