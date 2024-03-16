<?php

namespace Tests\Unit\Services\Auth;

use App\Data\Repositories\Abstracts\IEntityRepository;
use App\Domains\Services\Auth\Concretes\ForgotPasswordService;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Models\PasswordReset;
use Mockery\MockInterface;
use Tests\TestCase;

class ForgotPasswordServiceTest extends TestCase
{
    private ForgotPasswordRequest $request;
    private IEntityRepository $authRepository;

    public function test_success_forgot_password_service(): void
    {
        // Arrange
        $this->request = new ForgotPasswordRequest();
        $this->request['email'] = 'cliente@gmail.com';

        $this->authRepository = $this->mock(IEntityRepository::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('create')->with(PasswordReset::class)->andReturn(true);
        });

        // Act
        $forgotPasswordService = new ForgotPasswordService($this->authRepository);
        $result = $forgotPasswordService->forgotPassword($this->request);

        // Assert
        $this->assertTrue($result);
    }
}
