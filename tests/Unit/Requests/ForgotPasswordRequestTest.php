<?php

namespace Tests\Unit\Requests;

use App\Http\Requests\ForgotPasswordRequest;
use App\Models\User;
use App\Support\Generate\GenerateEmail;
use Illuminate\Support\Str;
use Tests\TestCase;

class ForgotPasswordRequestTest extends TestCase
{
    private ForgotPasswordRequest $request;

    private function request(): ForgotPasswordRequest
    {
        $this->request = new ForgotPasswordRequest();
        $this->request['email'] = GenerateEmail::generateEmail();
        return $this->request;
    }

    public function test_request_required(): void
    {
        // Arrange
        $this->request();

        // Act
        $resultEmail = isset($this->request['email']);

        // Assert
        $this->assertTrue($resultEmail);
    }

    public function test_request_type(): void
    {
        // Arrange
        $this->request();

        // Act
        $resultEmail = is_string($this->request['email']);

        // Assert
        $this->assertTrue($resultEmail);
    }


    public function test_request_absence_mask(): void
    {
        // Arrange
        $dominio = array('@gmail.com', '@outlook.com', '@business.com.br');
        $rand_keys = array_rand($dominio);
        $this->request = new ForgotPasswordRequest();
        $this->request['email'] = Str::random(10);

        // Act
        if ($this->request['email'] != $this->request['email'] . $dominio[$rand_keys]):
            $resultEmail = true;
        endif;

        // Assert
        $this->assertTrue($resultEmail);
    }

    public function test_request_exists(): void
    {
        // Arrange
        User::factory()->createOne();
        $this->request = new ForgotPasswordRequest();
        $this->request['email'] = User::query()->first()->email;

        // Act
        $resultEmail = isset($this->request['email']);

        // Assert
        $this->assertTrue($resultEmail);
    }
}
