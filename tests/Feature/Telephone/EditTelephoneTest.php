<?php

namespace Tests\Feature\Telephone;

use App\Models\Fornecedor;
use App\Models\Telefone;
use App\Models\User;
use App\Support\Enums\RoleEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EditTelephoneTest extends TestCase
{
    private function telephone(): array
    {
        return Telefone::factory()->createOne()->toArray();
    }

    /**
     * @test
     * @group telephone
     */
    public function it_endpoint_put_edit_user_base_response_200(): void
    {
        // Arrange
        $telephone = $this-> telephone();
        $data = [
            'id' => $telephone['id'],
            'ddd' => 85,
            'numero' => '(85)9' . rand(1000, 2000) . '-' . rand(1000, 2000),
            'tipo' => $telephone['tipo'],
            'usuarioId' => User::query()->first()->id,
            'ativo' => true,
        ];
        $authenticate = $this->authenticate(RoleEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('telephone.edit'), $data);

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     * @group telephone
     */
    public function it_endpoint_put_edit_provider_base_response_200(): void
    {
        // Arrange
        $telephone = $this-> telephone();
        $data = [
            'id' => $telephone['id'],
            'tipo' => $telephone['tipo'],
            'numero' => '(85)9' . rand(1000, 2000) . '-' . rand(1000, 2000),
            'fornecedorId' => Fornecedor::query()->first()->id,
            'ativo' => true,
        ];
        $authenticate = $this->authenticate(RoleEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('telephone.edit'), $data);

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     * @group telephone
     */
    public function it_endpoint_put_base_response_400(): void
    {
        // Arrange
        $telephone = $this-> telephone();
        $data = [
            'id' => $telephone['id'],
            'tipo' => $telephone['tipo'],
            'numero' => '(85)9' . rand(1000, 2000) . '-' . rand(1000, 2000),
            'usuarioId' => null,
            'ativo' => true,
        ];
        $authenticate = $this->authenticate(RoleEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('telephone.edit'), $data);

        // Assert
        $response->assertStatus(400);
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 400);
    }

    /**
     * @test
     * @group telephone
     */
    public function it_endpoint_put_base_response_401(): void
    {
        // Arrange
        $telephone = $this-> telephone();
        $data = [
            'id' => $telephone['id'],
            'tipo' => $telephone['tipo'],
            'numero' => '(85)9' . rand(1000, 2000) . '-' . rand(1000, 2000),
            'usuarioId' => User::query()->first()->id,
            'ativo' => true,
        ];

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $this->bearerTokenInvalid(),
        ])->putJson(route('telephone.edit'), $data);

        // Assert
        $response->assertUnauthorized();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 401);
    }

    /**
     * @test
     * @group telephone
     */
    public function it_endpoint_put_base_response_404(): void
    {
        // Arrange
        $telephone = $this-> telephone();
        $data = [
            'id' => $telephone['id'],
            'ddd' => 85,
            'numero' => '(85)9' . rand(1000, 2000) . '-' . rand(1000, 2000),
            'tipo' => $telephone['tipo'],
            'usuarioId' => 1000,
            'ativo' => true,
        ];
        $authenticate = $this->authenticate(RoleEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('telephone.edit'), $data);

        // Assert
        $response->assertNotFound();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 404);
    }
}
