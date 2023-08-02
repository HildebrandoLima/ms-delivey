<?php

namespace Tests\Unit\Services\Auth;

use App\Http\Requests\Auth\RefreshPasswordRequest;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use App\Services\Auth\Concretes\RefreshPasswordService;
use App\Support\Traits\GeneratePassword;
use Illuminate\Support\Str;
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
        $this->request = new RefreshPasswordRequest();
        $this->request['token'] = Str::uuid();
        $this->request['codigo'] = Str::random(10);
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
