<?php

namespace Tests\Unit\Services\Auth;

use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Models\PasswordReset;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use App\Services\Auth\Concretes\ForgotPasswordService;
use App\Support\Generate\GenerateEmail;
use Mockery\MockInterface;
use Tests\TestCase;

class ForgotPasswordServiceTest extends TestCase
{
    private ForgotPasswordRequest $request;
    private AuthRepositoryInterface $authRepository;

    public function test_success_forgot_password_service(): void
    {
        // Arrange
        $this->request = new ForgotPasswordRequest();
        $this->request['email'] = GenerateEmail::generateEmail();

        $this->authRepository = $this->mock(AuthRepositoryInterface::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('forgotPassword')->with(PasswordReset::class)->andReturn(true);
        });

        // Act
        $forgotPasswordService = new ForgotPasswordService($this->authRepository);

        $result = $forgotPasswordService->forgotPassword($this->request);

        // Assert
        $this->assertTrue($result);
    }
}
