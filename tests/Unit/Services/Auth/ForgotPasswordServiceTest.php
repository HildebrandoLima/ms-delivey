<?php

namespace Tests\Unit\Services\Auth;

use App\Http\Requests\ForgotPasswordRequest;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use App\Services\Auth\Concretes\ForgotPasswordService;
use Mockery\MockInterface;
use Illuminate\Support\Str;
use Tests\TestCase;

class ForgotPasswordServiceTest extends TestCase
{
    private ForgotPasswordRequest $request;
    private AuthRepositoryInterface $authRepository;

    public function test_success_forgot_password_service(): void
    {
        // Arrange
        $this->request = new ForgotPasswordRequest();
        $this->request['email'] = 'cliente@gmail.com';

        $this->authRepository = $this->mock(AuthRepositoryInterface::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('forgotPassword')->with(PasswordReset::class);
        });

        // Act
        $forgotPasswordService = new ForgotPasswordService($this->authRepository);

        $result = $forgotPasswordService->forgotPassword($this->request);
        dd($result);

        // Assert
        $this->assertTrue($result);
    }
}