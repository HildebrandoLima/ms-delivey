<?php

namespace Tests\Unit\Services\User;

use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\User\Concretes\EmailUserVerifiedAtService;
use Mockery\MockInterface;
use Tests\TestCase;

class EmailUserVerifiedAtServiceTest extends TestCase
{
    private CheckEntityRepositoryInterface $checkEntityRepository;
    private UserRepositoryInterface $userRepository;

    public function test_success_user_email_verified_at_service(): void
    {
        // Arrange
        $id = rand(1, 100);
        $active = true;
        $this->checkEntityRepository = $this->mock(CheckEntityRepositoryInterface::class,
            function (MockInterface $mock) use ($id) {
                $mock->shouldReceive('checkUserIdExist')->with($id);
        });

        $this->userRepository = $this->mock(UserRepositoryInterface::class,
            function (MockInterface $mock) use ($id, $active) {
                $mock->shouldReceive('emailVerifiedAt')->with($id, $active)->andReturn(true);
        });

        // Act
        $emailUserVerifiedAtService = new EmailUserVerifiedAtService
        (
            $this->checkEntityRepository,
            $this->userRepository
        );

        $result = $emailUserVerifiedAtService->emailVerifiedAt($id, $active);

        // Assert
        $this->assertTrue($result);
    }
}
