<?php

namespace Tests\Unit\Requests;

use App\Http\Requests\RefreshPasswordRequest;
use App\Models\PasswordReset;
use App\Support\Generate\GeneratePassword;
use Illuminate\Support\Str;
use Tests\TestCase;

class RefreshPasswordRequestTest extends TestCase
{
    private RefreshPasswordRequest $request;

    private function request(): RefreshPasswordRequest
    {
        $this->request = new RefreshPasswordRequest();
        $this->request['codigo'] = Str::random(10);
        $this->request['senha'] = GeneratePassword::generatePassword();
        return $this->request;
    }

    public function test_request_required(): void
    {
        // Arrange
        $this->request();

        // Act
        $resultCode = isset($this->request['codigo']);
        $resultPassword = isset($this->request['senha']);

        // Assert
        $this->assertTrue($resultCode);
        $this->assertTrue($resultPassword);
    }

    public function test_request_type(): void
    {
        // Arrange
        $this->request();

        // Act
        $resultCode = is_string($this->request['codigo']);
        $resultPassword = is_string($this->request['senha']);

        // Assert
        $this->assertTrue($resultCode);
        $this->assertTrue($resultPassword);
    }

    public function test_request_count_caracter(): void
    {
        // Arrange
        $this->request();

        // Act
        $resultCodeContString = strlen($this->request['codigo']);
        if ($resultCodeContString == 10):
            $resultCode = true;
        endif;

        // Assert
        $this->assertTrue($resultCode);
    }

    public function test_request_exists(): void
    {
        // Arrange
        $this->request = new RefreshPasswordRequest();
        $this->request['codigo'] = PasswordReset::query()->first()->codigo;

        // Act
        $resultCode = isset($this->request['codigo']);

        // Assert
        $this->assertTrue($resultCode);
    }

    public function test_request_invalid_password(): void
    {
        // Arrange
        $this->request = new RefreshPasswordRequest();
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
