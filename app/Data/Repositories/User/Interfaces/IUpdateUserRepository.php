<?php

namespace App\Data\Repositories\User\Interfaces;

use App\Http\Requests\User\EditUserRequest;

interface IUpdateUserRepository
{
    public function update(EditUserRequest $request): bool;
}
