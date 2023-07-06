<?php

namespace App\Services\User\Interfaces;

use App\Http\Requests\UserEditRequest;

interface EditUserServiceInterface
{
    public function editUser(int $id, UserEditRequest $request): bool;
}
