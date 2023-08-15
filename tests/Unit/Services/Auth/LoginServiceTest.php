<?php

namespace Tests\Unit\Services\Auth;

use App\Http\Requests\Auth\LoginRequest;
use App\Services\Auth\Concretes\LoginService;
use App\Support\Enums\PerfilEnum;
use Tests\TestCase;

class LoginServiceTest extends TestCase
{
    private LoginRequest $request;

    public function test_success_login_service(): void
    {
        // Arrange
        $this->request = new LoginRequest();

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
