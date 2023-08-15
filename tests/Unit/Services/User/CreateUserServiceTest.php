<?php

namespace Tests\Unit\Services\User;

use App\Http\Requests\User\CreateUserRequest;
use App\Models\PermissionUser;
use App\Models\User;
use App\Repositories\Abstracts\IEntityRepository;
use App\Repositories\Abstracts\IPermissionRepository;
use App\Services\User\Concretes\CreateUserService;
use App\Support\Traits\GenerateEmail;
use Mockery\MockInterface;
use Tests\TestCase;

class CreateUserServiceTest extends TestCase
{
    use GenerateEmail;
    private CreateUserRequest $request;
    private IEntityRepository $userRepository;
    private IPermissionRepository $permissionRepository;

    public function test_success_create_user_service(): void
    {
        // Arrange
        $this->request = new CreateUserRequest();
        $this->request['email'] = $this->generateEmail();
        $this->request['eAdmin'] = (bool)rand(0, 1);

        $this->userRepository = $this->mock(IEntityRepository::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('create')->with(User::class)->andReturn(true);
        });

        $this->permissionRepository = $this->mock(IPermissionRepository::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('create')->with(PermissionUser::class)->andReturn(true);
        });

        // Act
        $createUserService = new CreateUserService
        (
            $this->userRepository,
            $this->permissionRepository
        );

        $result = $createUserService->createUser($this->request);

        // Assert
        $this->assertIsInt($result);
    }
}
