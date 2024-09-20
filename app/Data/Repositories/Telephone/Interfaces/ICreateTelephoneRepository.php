<?php

namespace App\Data\Repositories\Telephone\Interfaces;

interface ICreateTelephoneRepository
{
    public function create(array $telefone): bool;
}
