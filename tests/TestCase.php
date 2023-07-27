<?php

namespace Tests;

use App\Models\User;
use App\Support\Enums\UserEnum;
use App\Support\Utils\Pagination\PaginationList;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Testing\TestResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use DateTime;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function authenticate(int $perfil): Collection
    {
        if ($perfil == 1):
            $perfil = $this->authenticateAdmin();
        else:
            $perfil = $this->authenticateCliente();
        endif;
        return collect([
            'accessToken' => auth()->attempt($perfil),
            'userId' => auth()->user()->id,
            'userName' => auth()->user()->name,
            'userEmail' => auth()->user()->email,
            'isAdmin' => auth()->user()->is_admin == 1 ? UserEnum::E_ADMIN : UserEnum::NAO_E_ADMIN,
            'permissions' => auth()->user()->permissions,
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
        return User::query()->whereNull('email_verified_at')->first()->email;
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

    public function paginationList(): Collection
    {
        return PaginationList::createFromPagination(new LengthAwarePaginator(
            400, 400, 10, null, []
        ));
    }

}
