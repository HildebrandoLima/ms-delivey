<?php

namespace Tests\Unit\Requests\User;

use App\Http\Requests\User\CreateUserRequest;
use App\Support\Generate\GenerateCPF;
use App\Support\Generate\GenerateEmail;
use App\Support\Generate\GeneratePassword;
use Illuminate\Support\Str;
use Tests\TestCase;

class CreateUserRequestTest extends TestCase
{
    private CreateUserRequest $request;
    private array $gender = array('Masculino', 'Feminino', 'Outro');

    private function request(): CreateUserRequest
    {
        $rand_keys = array_rand($this->gender);
        $this->request = new CreateUserRequest();
        $this->request['nome'] = Str::random(10);
        $this->request['cpf'] = GenerateCPF::generateCPF();
        $this->request['email'] = GenerateEmail::generateEmail();
        $this->request['senha'] = GeneratePassword::generatePassword();
        $this->request['dataNascimento'] = date('Y-m-d H:i:s');
        $this->request['genero'] = $this->gender[$rand_keys];
        $this->request['perfil'] = rand(0, 1); // 0 client 1 admin
        $this->request['ativo'] = true;
        return $this->request;
    }

    public function test_request_validation_rules(): void
    {
        // Arrange
        $this->request();

        // Act
        $data = [
            'nome' => 'required|string|unique:users,name',
            'cpf' => 'required|string|cpf|unique:users,cpf|min:14|max:14',
            'email' => 'required|string|unique:users,email|regex:/(.+)@(.+)\.(.+)/i',
            'senha' => 'required|string|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[$*&@#])[0-9a-zA-Z$*&@#]{8,}$/i',
            'dataNascimento' => 'required|date',
            'genero' => 'required|string',
            'perfil' => 'required|boolean',
            'ativo' => 'required|boolean',
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
        $resultCpf = isset($this->request['cpf']);
        $resultEmail = isset($this->request['email']);
        $resultPassword = isset($this->request['senha']);
        $resultDate = isset($this->request['dataNascimento']);
        $resultGender = isset($this->request['genero']);
        $resultProfile = isset($this->request['perfil']);
        $resultActive = isset($this->request['ativo']);

        // Assert
        $this->assertTrue($resultName);
        $this->assertTrue($resultCpf);
        $this->assertTrue($resultEmail);
        $this->assertTrue($resultPassword);
        $this->assertTrue($resultDate);
        $this->assertTrue($resultGender);
        $this->assertTrue($resultProfile);
        $this->assertTrue($resultActive);
    }

    public function test_request_type(): void
    {
        // Arrange
        $this->request();

        // Act
        $resultName = is_string($this->request['nome']);
        $resultCpf = is_string($this->request['cpf']);
        $resultEmail = is_string($this->request['email']);
        $resultPassword = is_string($this->request['senha']);
        $resultDate = $this->caseDate($this->request['dataNascimento']);
        $resultGender = is_string($this->request['genero']);
        $resultProfile = is_int($this->request['perfil']);
        $resultActive = is_bool($this->request['ativo']);

        // Assert
        $this->assertTrue($resultName);
        $this->assertTrue($resultCpf);
        $this->assertTrue($resultEmail);
        $this->assertTrue($resultPassword);
        $this->assertTrue($resultDate);
        $this->assertTrue($resultGender);
        $this->assertTrue($resultProfile);
        $this->assertTrue($resultActive);
    }

    public function test_request_absence_mask(): void
    {
        // Arrange
        $dominio = array('@gmail.com', '@outlook.com', '@business.com.br');
        $rand_keys = array_rand($dominio);
        $this->request();
        $this->request['cpf'] = str_replace(array('.','-','/'), "", GenerateCPF::generateCPF());
        $this->request['email'] = Str::random(10);

        // Act
        if ($this->request['cpf'] != $this->mask($this->request['cpf'], "###.###.###-##")):
            $resultCpf = true;
        endif;

        if ($this->request['email'] != $this->request['email'] . $dominio[$rand_keys]):
            $resultEmail = true;
        endif;

        // Assert
        $this->assertTrue($resultCpf);
        $this->assertTrue($resultEmail);
    }

    public function test_request_invalid_password(): void
    {
        // Arrange
        $this->request();
        $this->request['senha'] = GeneratePassword::generatePassword();

        // Act
        $resultPasswordContainsString = filter_var($this->request['senha'], FILTER_SANITIZE_STRING);
        $resultPasswordContainsNumber = filter_var($this->request['senha'], FILTER_SANITIZE_NUMBER_INT);
        $resultPasswordContainsSpecialCaracters = filter_var($this->request['senha'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $resultPasswordContString = strlen($this->request['senha']);

        if (isset($resultPasswordContainsString)):
            $resultPasswordContainsString = true;
        endif;

        if (isset($resultPasswordContainsNumber)):
            $resultPasswordContainsNumber = true;
        endif;

        if (isset($resultPasswordContainsSpecialCaracters)):
            $resultPasswordContainsSpecialCaracters = true;
        endif;

        if ($resultPasswordContString > 8):
            $resultPasswordContString = true;
        endif;

        // Assert
        $this->assertTrue($resultPasswordContainsString);
        $this->assertTrue($resultPasswordContainsNumber);
        $this->assertTrue($resultPasswordContainsSpecialCaracters);
        $this->assertTrue($resultPasswordContString);
    }
}