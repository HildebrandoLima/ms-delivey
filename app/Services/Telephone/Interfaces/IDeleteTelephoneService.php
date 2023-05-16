<?php

namespace App\Services\Telephone\Interfaces;

interface IDeleteTelephoneService
{
    public function deleteTelephone(int $id): bool;
}
