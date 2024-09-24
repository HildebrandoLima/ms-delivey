<?php

namespace Tests\Unit\Services\Auth;

use App\Data\Repositories\Auth\Interfaces\IForgotPasswordRepository;
use App\Domains\Services\Auth\Concretes\ForgotPasswordService;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use Mockery\MockInterface;
use Tests\TestCase;

class ForgotPasswordServiceTest extends TestCase
{
    private ForgotPasswordRequest $request;
    private IForgotPasswordRepository $forgotPasswordRepository;
    private array $data = [];

    protected function setUp(): void
    {
        parent::setUp();
        $this->data = $this->setDataAuth();
    }

    public function test_success_forgot_password_service(): void
    {
        // Arrange
        $this->request = new ForgotPasswordRequest();
        $this->request['email'] = $this->data['email'];

        $this->forgotPasswordRepository = $this->mock(IForgotPasswordRepository::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('create')
                     ->with($this->request)
                     ->andReturn(true);
        });

        // Act
        $forgotPasswordService = new ForgotPasswordService($this->forgotPasswordRepository);
        $result = $forgotPasswordService->forgotPassword($this->request);

        // Assert
        $this->assertTrue($result);
    }
}
