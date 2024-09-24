<?php

namespace Tests\Unit\Services\Auth;

use App\Data\Repositories\Auth\Interfaces\IAuthRepository;
use App\Domains\Services\Auth\Concretes\LogoutService;
use Mockery\MockInterface;
use Tests\TestCase;

class LogoutServiceTest extends TestCase
{
    private IAuthRepository $authRepository;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_success_logout_service(): void
    {
        // Arrange
        $this->authRepository = $this->mock(IAuthRepository::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('logout')
                     ->with()
                     ->andReturn(true);
        });

        // Act
        $logoutService = new LogoutService($this->authRepository);
        $result = $logoutService->logout();

        // Assert
        $this->assertTrue($result);
        $this->assertFalse(auth()->check());
    }
}
