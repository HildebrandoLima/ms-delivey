<?php

namespace App\Data\Repositories\Telephone\Interfaces;

interface ICreateTelephoneRepository
{
    public function create(array $telephone): bool;
}
