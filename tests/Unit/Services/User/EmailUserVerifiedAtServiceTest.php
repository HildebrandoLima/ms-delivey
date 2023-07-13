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
        $this->checkEntityRepository = $this->mock(CheckEntityRepositoryInterface::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('checkUserIdExist')->with(1);
        });

        $this->userRepository = $this->mock(UserRepositoryInterface::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('emailVerifiedAt')->with(1, 1)->andReturn(true);
        });

        // Act
        $emailUserVerifiedAtService = new EmailUserVerifiedAtService
        (
            $this->checkEntityRepository,
            $this->userRepository
        );

        $result = $emailUserVerifiedAtService->emailVerifiedAt(1, 1);

        // Assert
        $this->assertTrue($result);
    }
}
