<?php

namespace App\Services\User\Interfaces;

use App\Http\Requests\UserRequest;

interface IEditUserService
{
    public function editUser(int $id, UserRequest $request): bool;
}
