<?php

namespace Tests\Unit\Services\User;

use App\Data\Repositories\User\Interfaces\IEmailUserVerifiedAtRepository;
use App\Domains\Services\User\Concretes\EmailUserVerifiedAtService;
use Mockery\MockInterface;
use Tests\TestCase;

class EmailUserVerifiedAtServiceTest extends TestCase
{
    private IEmailUserVerifiedAtRepository $emailUserVerifiedAtRepository;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_success_user_email_verified_at_service(): void
    {
        // Arrange
        $id = rand(0, 100);

        $this->emailUserVerifiedAtRepository = $this->mock(IEmailUserVerifiedAtRepository::class,
            function (MockInterface $mock) use ($id) {
                $mock->shouldReceive('emailVerifiedAt')
                     ->with($id)
                     ->andReturn(true);
        });

        // Act
        $emailUserVerifiedAtService = new EmailUserVerifiedAtService($this->emailUserVerifiedAtRepository);
        $result = $emailUserVerifiedAtService->emailVerifiedAt($id);

        // Assert
        $this->assertTrue($result);
    }
}
