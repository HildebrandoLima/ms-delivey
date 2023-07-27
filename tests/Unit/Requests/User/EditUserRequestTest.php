<?php

namespace Tests\Unit\Requests;

use App\Http\Requests\User\EditUserRequest;
use App\Support\Generate\GenerateEmail;
use Illuminate\Support\Str;
use Tests\TestCase;

class EditUserRequestTest extends TestCase
{
    private EditUserRequest $request;
    private array $gender = array('Masculino', 'Feminino', 'Outro');

    private function request(): EditUserRequest
    {
        $rand_keys = array_rand($this->gender);
        $this->request = new EditUserRequest();
        $this->request['id'] = rand(1, 100);
        $this->request['nome'] = Str::random(10);
        $this->request['email'] = GenerateEmail::generateEmail();
        $this->request['genero'] = $this->gender[$rand_keys];
        $this->request['perfil'] = rand(0, 1); // 0 client 1 admin
        return $this->request;
    }

    public function test_request_validation_rules(): void
    {
        // Arrange
        $this->request();

        // Act
        $data = [
            'id' => 'required|int|exists:users,id',
            'nome' => 'required|string',
            'email' => 'required|string|regex:/(.+)@(.+)\.(.+)/i',
            'genero' => 'required|string',
        ];

        // Assert
        $this->assertEquals($data, $this->request()->rules());
    }

    public function test_request_required(): void
    {
        // Arrange
        $this->request();        

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
        $this->request();

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
        $this->request();
        $this->request['email'] = Str::random(10);

        // Act
        if ($this->request['email'] != $this->request['email'] . $dominio[$rand_keys]):
            $resultEmail = true;
        endif;

        // Assert
        $this->assertTrue($resultEmail);
    }
}
