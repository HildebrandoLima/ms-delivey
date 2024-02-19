<?php

namespace Tests\Unit\Services\Auth;

use App\Http\Requests\Auth\RefreshPasswordRequest;
use App\Models\User;
use App\Repositories\Abstracts\IEntityRepository;
use App\Repositories\Abstracts\IUserRepository;
use App\Services\Auth\Concretes\RefreshPasswordService;
use App\Support\Traits\GeneratePassword;
use Illuminate\Support\Str;
use Mockery\MockInterface;
use Tests\TestCase;

class RefreshPasswordServiceTest extends TestCase
{
    use GeneratePassword;
    private RefreshPasswordRequest $request;
    private IEntityRepository      $authRepository;
    private IUserRepository        $userRepository;

    public function test_success_reset_password_service(): void
    {
        // Arrange
        $this->request = new RefreshPasswordRequest();
        $this->request['token'] = Str::uuid();
        $this->request['codigo'] = Str::random(10);
        $this->request['senha'] = $this->generatePassword();

        $this->authRepository = $this->mock(IEntityRepository::class,
        function (MockInterface $mock) {
            $mock->shouldReceive('update')->with(User::class)->andReturn(true);
        });

        $this->userRepository = $this->mock(IUserRepository::class,
        function (MockInterface $mock) {
            $mock->shouldReceive('readCode')->with($this->request->codigo)->andReturn(2);
            $mock->shouldReceive('delete')->with($this->request->codigo)->andReturn(true);
        });

        // Act
        $refreshPasswordService = new RefreshPasswordService($this->authRepository, $this->userRepository);
        $result = $refreshPasswordService->refreshPassword($this->request);

        // Assert
        $this->assertTrue($result);
    }
}
