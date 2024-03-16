<?php

namespace Tests\Unit\Services\User;

use App\Data\Repositories\Abstracts\IEntityRepository;
use App\Domains\Models\User;
use App\Services\User\Concretes\EmailUserVerifiedAtService;
use Mockery\MockInterface;
use Tests\TestCase;

class EmailUserVerifiedAtServiceTest extends TestCase
{
    private IEntityRepository $userRepository;

    public function test_success_user_email_verified_at_service(): void
    {
        // Arrange
        $id = rand(0, 100);

        $this->userRepository = $this->mock(IEntityRepository::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('update')->with(User::class)->andReturn(true);
        });

        // Act
        $emailUserVerifiedAtService = new EmailUserVerifiedAtService($this->userRepository);
        $result = $emailUserVerifiedAtService->emailVerifiedAt($id);
        $mappedUser = $emailUserVerifiedAtService->map($id);

        // Assert
        $this->assertTrue($result);
        $this->assertInstanceOf(User::class, $mappedUser);
    }
}
