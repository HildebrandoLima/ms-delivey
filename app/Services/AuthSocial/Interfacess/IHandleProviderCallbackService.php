<?php

namespace App\Services\AuthSocial\Interfacess;

use Illuminate\Support\Collection;

interface IAuthSocialService
{
    public function authSocial(string $provider): Collection;
}
