<?php

namespace App\Services\User\Interfaces;

use App\Http\Requests\User\UserEditRequest;

interface EditUserServiceInterface
{
    public function editUser(UserEditRequest $request): bool;
}
