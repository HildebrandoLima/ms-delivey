<?php

namespace Tests\Unit\Services\Auth;

use App\Data\Repositories\Auth\Interfaces\IAuthResetRepository;
use App\Data\Repositories\Auth\Interfaces\IRefreshPasswordRepository;
use App\Domains\Services\Auth\Concretes\RefreshPasswordService;
use App\Http\Requests\Auth\RefreshPasswordRequest;
use Mockery\MockInterface;
use Tests\TestCase;

class RefreshPasswordServiceTest extends TestCase
{
    private RefreshPasswordRequest $request;
    private IAuthResetRepository $authResetRepository;
    private IRefreshPasswordRepository $refreshPasswordRepository;
    private array $data = [];
    private int $userId = 1;

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

        $this->authResetRepository = $this->mock(IAuthResetRepository::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('readCode')
                     ->with($this->request->codigo)
                     ->andReturn($this->userId);

                    $mock->shouldReceive('delete')
                         ->with($this->request->codigo)
                         ->andReturn(true);
        });

        $this->refreshPasswordRepository = $this->mock(IrefreshPasswordRepository::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('update')
                     ->with($this->userId, $this->request->senha)
                     ->andReturn(true);
        });

        // Act
        $refreshPasswordService = new RefreshPasswordService($this->authResetRepository, $this->refreshPasswordRepository);
        $result = $refreshPasswordService->refreshPassword($this->request);

        // Assert
        $this->assertTrue($result);
    }
}
