<?php

namespace Tests\Unit\Services\Auth;

use App\Http\Requests\Auth\LoginRequest;
use App\Services\Auth\Concretes\LoginService;
use App\Support\Enums\PerfilEnum;
use App\Support\Traits\GenerateEmail;
use App\Support\Traits\GeneratePassword;
use Tests\TestCase;

class LoginServiceTest extends TestCase
{
    use GenerateEmail, GeneratePassword;
    private LoginRequest $request;

    public function test_success_login_service(): void
    {
        // Arrange
        $this->request = new LoginRequest();
        $this->request['email'] = $this->generateEmail();
        $this->request['password'] = $this->generatePassword();

        $expectedResult = $this->authenticate(PerfilEnum::ADMIN);

        // Act
        $loginService = new LoginService();

        $result = $loginService->login($this->request);

        // Assert
        $this->assertIsArray($result->toArray());
        $this->assertIsArray($expectedResult->toArray());
        $this->assertEquals(count($result->toArray()), count($expectedResult->toArray()));
    }
}
