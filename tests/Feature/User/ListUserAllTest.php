<?php

namespace Tests\Feature\User;

use App\Models\User;
use App\Support\Utils\Enums\PerfilEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListUserAllTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_get_list_all_base_response_200(): void
    {
        // Arrange
        $data = User::factory(10)->make()->toArray();

        // Act
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->getJson(route('user.list.all', ['page' => 1, 'perPage' => 10, 'active' => 1]));

        // Assert
        $this->assertEquals(10, count($data));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     */
    public function it_endpoint_get_list_all_base_response_400(): void
    {
        // Arrange
        $data = User::factory(10)->make()->toArray();
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->getJson(route('user.list.all', ['page' => 1, 'perPage' => 10]));

        // Assert
        $this->assertEquals(10, count($data));
        $this->assertEquals($this->httpStatusCode($response), 400);
    }

    /**
     * @test
     */
    public function it_endpoint_get_list_all_base_response_401(): void
    {
        // Arrange
        User::factory(10)->make()->toArray();

        // Act
        $response = $this->getJson(route('user.list.all', ['page' => 1, 'perPage' => 10, 'active' => 1]));

        // Assert
        $this->assertEquals($this->httpStatusCode($response), 401);
    }
}
