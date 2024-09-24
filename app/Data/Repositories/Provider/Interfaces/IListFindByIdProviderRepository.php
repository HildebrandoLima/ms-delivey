<?php

namespace App\Data\Repositories\Provider\Interfaces;

use Illuminate\Support\Collection;

interface IListFindByIdProviderRepository
{
    public function listFindById(int $id, bool $active): Collection;
}
