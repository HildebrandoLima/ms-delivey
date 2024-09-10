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
    private IEntityRepository $entityRepository;
    private array $data;

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

        $this->entityRepository = $this->mock(IEntityRepository::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('create')->with(PasswordReset::class)->andReturn(true);
        });

        // Act
        $forgotPasswordService = new ForgotPasswordService($this->entityRepository);
        $result = $forgotPasswordService->forgotPassword($this->request);

        // Assert
        $this->assertTrue($result);
    }
}
