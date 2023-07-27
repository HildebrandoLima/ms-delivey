<?php

namespace Tests\Feature\Telephone;

use App\Models\Fornecedor;
use App\Models\Telefone;
use App\Models\User;
use App\Support\Enums\PerfilEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EditTelephoneTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_put_edit_user_base_response_200(): void
    {
        // Arrange
        $telephone = Telefone::query()->first()->toArray();
        $data = [
            "id" => $telephone['id'],
            "numero" => '9' . rand(1000, 2000) . '-' . rand(1000, 2000),
            "tipo" => $telephone['tipo'],
            "dddId" => $telephone['ddd_id'],
            "usuarioId" => User::query()->first()->id,
            "ativo" => $telephone['ativo'],
        ];
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

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
     */
    public function it_endpoint_put_edit_provider_base_response_200(): void
    {
        // Arrange
        $telephone = Telefone::query()->first()->toArray();
        $data = [
            "id" => $telephone['id'],
            "numero" => '9' . rand(1000, 2000) . '-' . rand(1000, 2000),
            "tipo" => $telephone['tipo'],
            "dddId" => $telephone['ddd_id'],
            "fornecedorId" => Fornecedor::query()->first()->id,
            "ativo" => $telephone['ativo'],
        ];
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

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
     */
    public function it_endpoint_put_base_response_400(): void
    {
        // Arrange
        $telephone = Telefone::query()->first()->toArray();
        $data = [
            "id" => $telephone['id'],
            "numero" => '9' . rand(1000, 2000) . '-' . rand(1000, 2000),
            "tipo" => $telephone['tipo'],
            "dddId" => $telephone['ddd_id'],
            "usuarioId" => null,
            "ativo" => $telephone['ativo'],
        ];
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

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
     */
    public function it_endpoint_put_base_response_401(): void
    {
        // Arrange
        $telephone = Telefone::query()->first()->toArray();
        $data = [
            "id" => $telephone['id'],
            "numero" => '9' . rand(1000, 2000) . '-' . rand(1000, 2000),
            "tipo" => $telephone['tipo'],
            "dddId" => $telephone['ddd_id'],
            "usuarioId" => User::query()->first()->id,
            "ativo" => $telephone['ativo'],
        ];

        // Act
        $response = $this->putJson(route('telephone.edit'), $data);

        // Assert
        $response->assertUnauthorized();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 401);
    }
}
