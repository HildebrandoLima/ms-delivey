<?php

namespace Tests\Unit\Services\Auth;

use App\Domains\Services\Auth\Concretes\LogoutService;
use App\Http\Requests\Auth\LoginRequest;
use App\Support\Enums\RoleEnum;
use Tests\TestCase;

class LogoutServiceTest extends TestCase
{
    private LoginRequest $request;

    public function test_success_logout_service(): void
    {
        // Arrange
        $this->request = new LoginRequest();
        $this->request['email'] = 'hildebrandolima16@gmail.com';
        $this->request['password'] = 'HiLd3br@ndo';
        $this->authenticate(RoleEnum::ADMIN);

        // Act
        $loginService = new LogoutService();
        $result = $loginService->logout();

        // Assert
        $this->assertTrue($result);
        $this->assertFalse(auth()->check());
    }
}
