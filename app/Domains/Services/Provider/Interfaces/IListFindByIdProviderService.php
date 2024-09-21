<?php

namespace App\Domains\Services\Provider\Interfaces;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface IListFindByIdProviderService
{
    public function listFindById(Request $request): Collection;
}
