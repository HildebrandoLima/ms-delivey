<?php

namespace App\Domains\Services\Provider\Abstracts;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface IListProviderService
{
    public function listProviderAll(Request $request): Collection;
    public function listProviderFind(Request $request): Collection;
}
