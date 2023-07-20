<?php

namespace Tests\Unit\Requests;

use App\Http\Requests\LoginRequest;
use App\Support\Generate\GenerateEmail;
use App\Support\Generate\GeneratePassword;
use Illuminate\Support\Str;
use Tests\TestCase;

class LoginRequestTest extends TestCase
{
    private LoginRequest $request;

    private function request(): LoginRequest
    {
        $this->request = new LoginRequest();
        $this->request['email'] = GenerateEmail::generateEmail();
        $this->request['senha'] = GeneratePassword::generatePassword();
        return $this->request;
    }

    public function test_request_required(): void
    {
        // Arrange
        $this->request();

        // Act
        $resultEmail = isset($this->request['email']);
        $resultPassword = isset($this->request['senha']);

        // Assert
        $this->assertTrue($resultEmail);
        $this->assertTrue($resultPassword);
    }

    public function test_request_type(): void
    {
        // Arrange
        $this->request();

        // Act
        $resultEmail = is_string($this->request['email']);
        $resultPassword = is_string($this->request['senha']);

        // Assert
        $this->assertTrue($resultEmail);
        $this->assertTrue($resultPassword);
    }

    public function test_request_absence_mask(): void
    {
        // Arrange
        $dominio = array('@gmail.com', '@outlook.com', '@business.com.br');
        $rand_keys = array_rand($dominio);
        $this->request = new LoginRequest();
        $this->request['email'] = Str::random(10);

        // Act
        if ($this->request['email'] != $this->request['email'] . $dominio[$rand_keys]):
            $resultEmail = true;
        endif;

        // Assert
        $this->assertTrue($resultEmail);
    }

    public function test_request_invalid_password(): void
    {
        // Arrange
        $this->request();

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
