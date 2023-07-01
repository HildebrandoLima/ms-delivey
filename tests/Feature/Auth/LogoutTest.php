<?php

namespace Tests\Feature\Auth;

use App\Support\Utils\Enums\PerfilEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_logout_a_successful_response(): void
    {
        $authenticate = $this->authenticate(PerfilEnum::ADMIN);
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->postJson(route('auth.logout'));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     */
    public function it_endpoint_logout_base_response_401(): void
    {
        $response = $this->postJson(route('auth.logout'));
        $this->assertEquals($this->httpStatusCode($response), 401);
    }
}
