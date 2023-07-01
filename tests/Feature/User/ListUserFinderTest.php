<?php

namespace Tests\Feature\User;

use App\Models\User;
use App\Support\Utils\Enums\PerfilEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListUserFinderTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_get_list_find_base_response_200(): void
    {
        // Arrange
        $user = User::factory()->createOne();
        $data = $user->toArray();
        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->getJson(route('user.list.find', ['id' => base64_encode($data['id']), 'active' => 1]));

        // Assert
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     */
    public function it_endpoint_get_list_find_base_response_400(): void
    {
        // Arrange
        $user = User::factory()->createOne();
        $data = $user->toArray();
        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->getJson(route('user.list.find', ['id' => base64_encode($data['id'])]));

        // Assert
        $this->assertEquals($this->httpStatusCode($response), 400);
    }

    /**
     * @test
     */
    public function it_endpoint_get_list_find_user_exist_base_response_400(): void
    {
        // Arrange
        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->getJson(route('user.list.find', ['id' => base64_encode(3)]));

        // Assert
        $this->assertEquals($this->httpStatusCode($response), 400);
    }
}
