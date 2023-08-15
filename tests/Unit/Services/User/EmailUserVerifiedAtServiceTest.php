<?php

namespace Tests\Unit\Services\User;

use App\Models\User;
use App\Repositories\Abstracts\IEntityRepository;
use App\Services\User\Concretes\EmailUserVerifiedAtService;
use Mockery\MockInterface;
use Tests\TestCase;

class EmailUserVerifiedAtServiceTest extends TestCase
{
    private IEntityRepository $userRepository;

    public function test_success_user_email_verified_at_service(): void
    {
        // Arrange
        $this->userRepository = $this->mock(IEntityRepository::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('update')->with(User::class)->andReturn(true);
        });

        // Act
        $emailUserVerifiedAtService = new EmailUserVerifiedAtService($this->userRepository);

        $result = $emailUserVerifiedAtService->emailVerifiedAt(rand(1, 100), true);

        // Assert
        $this->assertTrue($result);
    }
}
