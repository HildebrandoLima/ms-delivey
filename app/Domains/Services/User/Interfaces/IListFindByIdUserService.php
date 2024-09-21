<?php

namespace App\Domains\Services\User\Interfaces;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface IListFindByIdUserService
{
    public function listFindById(Request $request): Collection;
}
