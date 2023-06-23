<?php

namespace App\Services\User\Interfaces;

use App\Http\Requests\UserRequest;

interface EditUserServiceInterface
{
    public function editUser(int $id, UserRequest $request): bool;
}
