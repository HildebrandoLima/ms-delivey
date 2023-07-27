<?php

namespace Tests\Unit\Services\User;

use App\Http\Requests\User\EditUserRequest;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\User\Concretes\EditUserService;
use App\Support\Generate\GenerateEmail;
use App\Support\Enums\PerfilEnum;
use Illuminate\Support\Str;
use Mockery\MockInterface;
use Tests\TestCase;

class EditUserServiceTest extends TestCase
{
    private EditUserRequest $request;
    private UserRepositoryInterface $userRepository;
    private array $gender = array('Masculino', 'Feminino', 'Outro');

    public function test_success_edit_user_service(): void
    {
        // Arrange
        $rand_keys = array_rand($this->gender);
        $this->request = new EditUserRequest();
        $this->request['id'] = rand(1, 100);
        $this->request['nome'] = Str::random(10);
        $this->request['email'] = GenerateEmail::generateEmail();
        $this->request['genero'] = $this->gender[$rand_keys];
        $this->request['ativo'] = true;

        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->userRepository = $this->mock(UserRepositoryInterface::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('update')->with(User::class)->andReturn(true);
        });

        // Act
        $editUserService = new EditUserService($this->userRepository);

        $result = $editUserService->editUser($this->request);

        // Assert
        $this->assertTrue($result);
    }
}
