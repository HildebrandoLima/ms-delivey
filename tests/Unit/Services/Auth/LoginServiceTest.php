<?php

namespace Tests\Unit\Services\Auth;

use App\Http\Requests\LoginRequest;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Services\Auth\Concretes\LoginService;
use App\Support\Enums\PerfilEnum;
use App\Support\Generate\GenerateEmail;
use App\Support\Generate\GeneratePassword;
use Mockery\MockInterface;
use Tests\TestCase;

class LoginServiceTest extends TestCase
{
    private LoginRequest $request;
    private CheckEntityRepositoryInterface $checkEntityRepository;

    public function test_success_login_service(): void
    {
        // Arrange
        $this->request = new LoginRequest();
        $this->request['email'] = GenerateEmail::generateEmail();
        $this->request['password'] = GeneratePassword::generatePassword();

        $expectedResult = $this->authenticate(PerfilEnum::ADMIN);

        $this->checkEntityRepository = $this->mock(CheckEntityRepositoryInterface::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('checkFirstAccess')->with($this->request['email']);
        });

        // Act
        $loginService = new LoginService($this->checkEntityRepository);

        $result = $loginService->login($this->request);

        // Assert
        $this->assertIsArray($result->toArray());
        $this->assertIsArray($expectedResult->toArray());
        $this->assertEquals(count($result->toArray()), count($expectedResult->toArray()));
    }
}
