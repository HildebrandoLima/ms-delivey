<?php

namespace App\Domains\Services\User\Abstracts;

use App\Http\Requests\User\EditUserRequest;

interface IEditUserService
{
    public function editUser(EditUserRequest $request): bool;
}
