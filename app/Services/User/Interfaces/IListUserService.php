<?php

namespace App\Services\User\Interfaces;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface IListUserService
{
    public function listUserAll(Request $request, string $search): Collection;
    public function listUserFind(int $id): Collection;
}
