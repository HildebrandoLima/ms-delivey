<?php

namespace Tests\Unit\Services\Auth;

use App\Http\Requests\Auth\RefreshPasswordRequest;
use App\Models\PasswordReset;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use App\Services\Auth\Concretes\RefreshPasswordService;
use App\Support\Traits\GeneratePassword;
use Mockery\MockInterface;
use Tests\TestCase;

class RefreshPasswordServiceTest extends TestCase
{
    use GeneratePassword;
    private RefreshPasswordRequest $request;
    private AuthRepositoryInterface $authRepository;

    public function test_success_reset_password_service(): void
    {
        // Arrange
        PasswordReset::factory()->createOne();
        $data = PasswordReset::query()->first()->toArray();
        $this->request = new RefreshPasswordRequest();
        $this->request['token'] = $data['token'];
        $this->request['codigo'] = $data['codigo'];
        $this->request['password'] = $this->generatePassword();

        $this->authRepository = $this->mock(AuthRepositoryInterface::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('refreshPassword')->with($this->request)->andReturn(true);
        });

        // Act
        $refreshPasswordService = new RefreshPasswordService($this->authRepository);

        $result = $refreshPasswordService->refreshPassword($this->request);

        // Assert
        $this->assertTrue($result);
    }
}
