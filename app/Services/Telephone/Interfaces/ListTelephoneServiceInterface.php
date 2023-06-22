<?php

namespace App\Services\Telephone\Interfaces;

use Illuminate\Support\Collection;

interface ListTelephoneServiceInterface
{
    public function listDDDAll(): Collection;
}
