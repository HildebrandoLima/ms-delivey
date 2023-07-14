<?php

namespace Tests\Unit\Services\Auth;

use App\Services\Auth\Concretes\LogoutService;
use App\Support\Utils\Enums\PerfilEnum;
use Tests\TestCase;

class LogoutServiceTest extends TestCase
{
    public function test_success_logout_service(): void
    {
        // Arrange
        $this->authenticate(PerfilEnum::ADMIN);

        // Act
        $loginService = new LogoutService();

        $result = $loginService->logout();

        // Assert
        $this->assertTrue($result);
    }
}
