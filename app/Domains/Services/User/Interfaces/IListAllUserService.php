<?php

namespace App\Domains\Services\User\Interfaces;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface IListAllUserService
{
    public function listAll(Request $request): Collection;
}
