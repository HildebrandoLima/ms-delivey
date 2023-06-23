<?php

namespace App\Services\Telephone\Concretes;

use App\Repositories\Interfaces\TelephoneRepositoryInterface;
use App\Services\Telephone\Interfaces\ListTelephoneServiceInterface;
use Illuminate\Support\Collection;

class ListTelephoneService implements ListTelephoneServiceInterface
{
    private TelephoneRepositoryInterface $telephoneRepository;

    public function __construct(TelephoneRepositoryInterface $telephoneRepository)
    {
        $this->telephoneRepository = $telephoneRepository;
    }

    public function listDDDAll(): Collection
    {
        return $this->telephoneRepository->getDDDAll();
    }
}
