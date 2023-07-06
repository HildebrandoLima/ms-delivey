<?php

namespace Tests;

use App\Support\Utils\Enums\UserEnum;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Testing\TestResponse;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function authenticate(int $perfil): array
    {
        if ($perfil == 1):
            $perfil = $this->authenticateAdmin();
        else:
            $perfil = $this->authenticateCliente();
        endif;
        return [
            'accessToken' => auth()->attempt($perfil),
            'userId' => auth()->user()->id,
            'userName' => auth()->user()->name,
            'userEmail' => auth()->user()->email,
            'isAdmin' => auth()->user()->is_admin == 1 ? UserEnum::E_ADMIN : UserEnum::NAO_E_ADMIN,
            'permissions' => auth()->user()->permissions,
        ];
    }

    public function authenticateAdmin(): array
    {
        return [
            'email' => 'hildebrandolima16@gmail.com',
            'password' => 'HiLd3br@ndo'
        ];
    }

    public function authenticateCliente(): array
    {
        return [
            'email' => 'cliente@gmail.com',
            'password' => '@PClient5'
        ];
    }

    public function httpStatusCode(TestResponse $response): int
    {
        return $response->baseResponse->original['status'];
    }

    public function baseResponse(TestResponse $response): string
    {
        return json_encode($response->baseResponse->original);
    }

    public function countPaginateList(TestResponse $response): int
    {
        return count($response->baseResponse->original['data']['list']);
    }
}
