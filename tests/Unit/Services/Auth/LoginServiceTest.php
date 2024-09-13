<?php

namespace Tests\Unit\Services\Auth;

use App\Data\Repositories\Abstracts\IAuthRepository;
use App\Domains\Services\Auth\Concretes\LoginService;
use App\Http\Requests\Auth\LoginRequest;
use Mockery\MockInterface;
use Tests\TestCase;

class LoginServiceTest extends TestCase
{
    private LoginRequest $request;
    private IAuthRepository $authRepository;
    private array $data;

    protected function setUp(): void
    {
        parent::setUp();
        $this->data = $this->setDataAuth();
    }

    public function test_success_login_service(): void
    {
        // Arrange
        $this->request = new LoginRequest();
        $this->request['email'] = $this->data['email'];
        $this->request['password'] = $this->data['password'];
        $expectedResult = collect(['accessToken' => bin2hex(random_bytes(32))]);

        $this->authRepository = $this->mock(IAuthRepository::class,
            function (MockInterface $mock) use ($expectedResult) {
                $mock->shouldReceive('login')->with($this->request)->andReturn($expectedResult);
        });

        // Act
        $loginService = new LoginService($this->authRepository);
        $result = $loginService->login($this->request);

        // Assert
        $this->assertArrayHasKey('accessToken', $result->toArray());
        $this->assertIsArray($result->toArray());
    }
}
