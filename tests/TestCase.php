<?php

namespace Tests;

use App\Models\User;
use App\Support\Utils\Pagination\PaginationList;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Testing\TestResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use DateTime;
use Mockery;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function bearerTokenInvalid(): string
    {
        return 'x4md1lfkewofqimvSKNDIEWHI@L';
    }

    public function authenticate(int $perfil): Collection
    {
        if ($perfil === 1):
            $perfil = $this->authenticateAdmin();
        else:
            $perfil = $this->authenticateCliente();
        endif;

        $auth = auth()->attempt($perfil);
        $user = auth()->user();

        return collect([
            'accessToken' => $auth,
            'userId' => $user->id,
            'userName' => $user->name,
            'userEmail' => $user->email,
            'role' => $user->role,
            'permissions' => $user->permissions(),
        ]);
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

    public function emailVerifiedAt(): string
    {
        return User::query()->whereNull('email_verificado_em')->first()->email;
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

    public function paginationList(): Collection
    {
        return PaginationList::createFromPagination(new LengthAwarePaginator(400, 400, 10, null, []));
    }

    public function caseDate(string $dateRequest): bool
    {
        $date = DateTime::createFromFormat('Y-m-d H:i:s', $dateRequest);
        if ($date && $date->format('Y-m-d H:i:s') == $dateRequest):
            return true;
        else:
            return false;
        endif;
    }

    public function mask(int $value, string $format): string
    {
        $mask = '';
        $position_value = 0;
        for ($i = 0; $i <= strlen($format) - 1; $i++):
            if ($format[$i] == '#'):
                if (isset($value[$position_value])):
                    $mask .= $value[$position_value++];
                endif;
            else:
                $mask .= $format[$i];
            endif;
        endfor;
        return $mask;
    }

    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
