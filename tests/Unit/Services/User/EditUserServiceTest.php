<?php

namespace Tests\Unit\Services\User;

use App\Http\Requests\UserEditRequest;
use App\Models\User;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\User\Concretes\EditUserService;
use App\Support\Generate\GenerateEmail;
use App\Support\Utils\Enums\PerfilEnum;
use Illuminate\Support\Str;
use Mockery\MockInterface;
use Tests\TestCase;

class EditUserServiceTest extends TestCase
{
    private UserEditRequest $request;
    private CheckEntityRepositoryInterface $checkEntityRepository;
    private UserRepositoryInterface $userRepository;
    private array $gender = array('Masculino', 'Feminino', 'Outro');

    public function test_success_edit_user_service(): void
    {
        // Arrange
        $rand_keys = array_rand($this->gender);
        $this->request = new UserEditRequest();
        $this->request['nome'] = Str::random(10);
        $this->request['email'] = GenerateEmail::generateEmail();
        $this->request['genero'] = $this->gender[$rand_keys];

        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->checkEntityRepository = $this->mock(CheckEntityRepositoryInterface::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('checkUserIdExist')->with(1);
        });

        $this->userRepository = $this->mock(UserRepositoryInterface::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('update')->with(1, User::class)->andReturn(1);
        });

        // Act
        $editUserService = new EditUserService
        (
            $this->checkEntityRepository,
            $this->userRepository
        );

        $result = $editUserService->editUser(1, $this->request);

        // Assert
        $this->assertTrue($result);
    }
}
