<?php

namespace App\Domains\Services\User\Abstracts;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface IListUserService
{
    public function listUserAll(Request $request): Collection;
    public function listUserFind(Request $request): Collection;
}
