<?php

namespace App\Domains\Services\Provider\Interfaces;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface IListAllProviderService
{
    public function listAll(Request $request): Collection;
}
