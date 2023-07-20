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
    private int $id;
    private bool $active; 

    public function test_success_user_email_verified_at_service(): void
    {
        // Arrange
        $this->id = rand(1, 100);
        $this->active = true;
        $this->checkEntityRepository = $this->mock(CheckEntityRepositoryInterface::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('checkUserIdExist')->with($this->id);
        });

        $this->userRepository = $this->mock(UserRepositoryInterface::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('emailVerifiedAt')->with($this->id, $this->active)
                     ->andReturn(true);
        });

        // Act
        $emailUserVerifiedAtService = new EmailUserVerifiedAtService
        (
            $this->checkEntityRepository,
            $this->userRepository
        );

        $result = $emailUserVerifiedAtService->emailVerifiedAt($this->id, $this->active);

        // Assert
        $this->assertTrue($result);
    }
}
