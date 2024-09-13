<?php

namespace Tests\Unit\Services\Auth;

use App\Data\Repositories\Abstracts\IAuthRepository;
use App\Data\Repositories\Abstracts\IEntityRepository;
use App\Domains\Services\Auth\Concretes\RefreshPasswordService;
use App\Http\Requests\Auth\RefreshPasswordRequest;
use App\Models\User;
use Mockery\MockInterface;
use Tests\TestCase;

class RefreshPasswordServiceTest extends TestCase
{
    private RefreshPasswordRequest $request;
    private IEntityRepository $entityRepository;
    private IAuthRepository $authRepository;
    private array $data;

    protected function setUp(): void
    {
        parent::setUp();
        $this->data = $this->setDataAuth();
    }

    public function test_success_reset_password_service(): void
    {
        // Arrange
        $this->request = new RefreshPasswordRequest();
        $this->request['token'] = $this->data['token'];
        $this->request['codigo'] = $this->data['codigo'];
        $this->request['senha'] = $this->data['senha'];

        // Mocking IAuthRepository
        $this->authRepository = $this->mock(IAuthRepository::class, function (MockInterface $mock) {
            $mock->shouldReceive('readCode')->with($this->request['codigo'])->andReturn(1);
            $mock->shouldReceive('delete')->with($this->request['codigo'])->andReturn(true);
        });

        // Mocking IEntityRepository
        $this->entityRepository = $this->mock(IEntityRepository::class, function (MockInterface $mock) {
            $mock->shouldReceive('update')->with(User::class)->andReturn(true);
        });

        // Act
        $refreshPasswordService = new RefreshPasswordService($this->authRepository, $this->entityRepository);
        $result = $refreshPasswordService->refreshPassword($this->request);

        // Assert
        $this->assertTrue($result);
    }
}
