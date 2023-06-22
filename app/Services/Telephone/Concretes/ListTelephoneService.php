<?php

namespace App\Services\Telephone\Concretes;

use App\Repositories\Interfaces\TelephoneRepositoryInterface;
use App\Services\Telephone\Interfaces\ListTelephoneServiceInterface;
use Illuminate\Support\Collection;

class ListTelephoneService implements ListTelephoneServiceInterface
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
