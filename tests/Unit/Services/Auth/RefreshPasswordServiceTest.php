<?php

namespace Tests\Unit\Services\Auth;

use App\Http\Requests\RefreshPasswordRequest;
use App\Models\PasswordReset;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Services\Auth\Concretes\RefreshPasswordService;
use App\Support\Generate\GeneratePassword;
use Mockery\MockInterface;
use Tests\TestCase;

class RefreshPasswordServiceTest extends TestCase
{
    private RefreshPasswordRequest $request;
    private CheckEntityRepositoryInterface $checkEntityRepository;
    private AuthRepositoryInterface $authRepository;

    public function test_success_reset_password_service(): void
    {
        // Arrange
        $data = PasswordReset::query()->first()->toArray();
        $this->request = new RefreshPasswordRequest();
        $this->request['codigo'] = $data['codigo'];
        $this->request['password'] = GeneratePassword::generatePassword();

        $this->checkEntityRepository = $this->mock(CheckEntityRepositoryInterface::class,
        function (MockInterface $mock) use ($data) {
            $mock->shouldReceive('checkTokenPassword')->with($data['token']);
            $mock->shouldReceive('checkUserCodeRefreshPassword')->with($data['codigo']);
        });

        $this->authRepository = $this->mock(AuthRepositoryInterface::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('refreshPassword')->with($this->request)->andReturn(true);
        });

        // Act
        $refreshPasswordService = new RefreshPasswordService
        (
            $this->checkEntityRepository,
            $this->authRepository
        );

        $result = $refreshPasswordService->refreshPassword($this->request, $data['token']);

        // Assert
        $this->assertTrue($result);
    }
}
