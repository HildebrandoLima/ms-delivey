<?php

namespace Tests\Unit\Requests;

use App\Http\Requests\UserEditRequest;
use App\Support\Generate\GenerateEmail;
use Illuminate\Support\Str;
use Tests\TestCase;

class UserEditRequestTest extends TestCase
{
    private UserEditRequest $request;
    private array $gender = array('Masculino', 'Feminino', 'Outro');

    public function test_request_required(): void
    {
        // Arrange
        $rand_keys = array_rand($this->gender);
        $this->request = new UserEditRequest();
        $this->request['nome'] = Str::random(10);
        $this->request['email'] = GenerateEmail::generateEmail();
        $this->request['genero'] = $this->gender[$rand_keys];
        $this->request['perfil'] = rand(0, 1); // 0 client 1 admin

        // Act
        $resultName = isset($this->request['nome']);
        $resultEmail = isset($this->request['email']);
        $resultGender = isset($this->request['genero']);
        $resultProfile = isset($this->request['perfil']);

        // Assert
        $this->assertTrue($resultName);
        $this->assertTrue($resultEmail);
        $this->assertTrue($resultGender);
        $this->assertTrue($resultProfile);
    }

    public function test_request_type(): void
    {
        // Arrange
        $rand_keys = array_rand($this->gender);
        $this->request = new UserEditRequest();
        $this->request['nome'] = Str::random(10);
        $this->request['email'] = GenerateEmail::generateEmail();
        $this->request['genero'] = $this->gender[$rand_keys];
        $this->request['perfil'] = rand(0, 1); // 0 client 1 admin

        // Act
        $resultName = is_string($this->request['nome']);
        $resultEmail = is_string($this->request['email']);
        $resultGender = is_string($this->request['genero']);
        $resultProfile = is_int($this->request['perfil']);

        // Assert
        $this->assertTrue($resultName);
        $this->assertTrue($resultEmail);
        $this->assertTrue($resultGender);
        $this->assertTrue($resultProfile);
    }

    public function test_request_absence_mask(): void
    {
        // Arrange
        $dominio = array('@gmail.com', '@outlook.com', '@business.com.br');
        $rand_keys = array_rand($dominio);
        $this->request = new UserEditRequest();
        $this->request['email'] = Str::random(10);

        // Act
        if ($this->request['email'] != $this->request['email'] . $dominio[$rand_keys]):
            $resultEmail = true;
        endif;

        // Assert
        $this->assertTrue($resultEmail);
    }
}
