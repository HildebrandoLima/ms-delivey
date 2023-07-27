<?php

namespace Tests\Unit\Services\User;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\User\Concretes\EmailUserVerifiedAtService;
use Mockery\MockInterface;
use Tests\TestCase;

class EmailUserVerifiedAtServiceTest extends TestCase
{
    private UserRepositoryInterface $userRepository;
    private int $id;
    private bool $active; 

    public function test_success_user_email_verified_at_service(): void
    {
        // Arrange
        $this->id = rand(1, 100);
        $this->active = true;

        $this->userRepository = $this->mock(UserRepositoryInterface::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('emailVerifiedAt')->with($this->id, $this->active)
                     ->andReturn(true);
        });

        // Act
        $emailUserVerifiedAtService = new EmailUserVerifiedAtService($this->userRepository);

        $result = $emailUserVerifiedAtService->emailVerifiedAt($this->id, $this->active);

        // Assert
        $this->assertTrue($result);
    }
}
