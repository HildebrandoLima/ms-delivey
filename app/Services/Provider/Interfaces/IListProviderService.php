<?php

namespace App\Services\Provider\Interfaces;

use App\Http\Requests\ProviderRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface IListProviderService
{
    public function listProviderAll(Request $request, string $search): Collection;
    public function listProviderFind(int $id): Collection;
}
