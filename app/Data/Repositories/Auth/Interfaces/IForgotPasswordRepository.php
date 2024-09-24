<?php

namespace App\Data\Repositories\Auth\Interfaces;

use App\Http\Requests\Auth\ForgotPasswordRequest;

interface IForgotPasswordRepository
{
    public function create(ForgotPasswordRequest $request): int;
}
