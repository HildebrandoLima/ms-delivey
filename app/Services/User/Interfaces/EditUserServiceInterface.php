<?php

namespace App\Services\User\Interfaces;

use App\Http\Requests\User\EditUserRequest;

interface EditUserServiceInterface
{
    public function editUser(EditUserRequest $request): bool;
}
