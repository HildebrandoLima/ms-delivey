<?php

namespace App\Data\Repositories\User\Interfaces;

use Illuminate\Support\Collection;

interface IListFindByIdUserRepository
{
    public function listFindById(int $id, bool $active): Collection;
}
