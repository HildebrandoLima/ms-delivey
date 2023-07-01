<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_login_a_successful_response(): void
    {
        $data = [
            'email' => 'hildebrandolima16@gmail.com',
            'password' => 'HiLd3br@ndo'
        ];
        $response = $this->postJson(route('auth.login'), $data);
        $response->assertStatus(200);
    }
}
