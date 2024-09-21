<?php

namespace App\Domains\Services\User\Interfaces;

use App\Http\Requests\User\UpdateUserRequest;

interface IUpdateUserService
{
    public function update(UpdateUserRequest $request): bool;
}
