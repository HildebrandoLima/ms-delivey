<?php

namespace Tests\Feature\Telephone;

use App\Models\Fornecedor;
use App\Models\Telefone;
use App\Models\User;
use App\Support\Utils\Enums\PerfilEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EditTelephoneTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_put_update_base_response_200_edit_user(): void
    {
        // Arrange
        $data['telefones'] = [];
        $telephone = Telefone::query()->first()->toArray();
        $newTelephone = [
            "numero" => '9' . rand(1000, 2000) . '-' . rand(1000, 2000),
            "tipo" => $telephone['tipo'],
            "dddId" => $telephone['ddd_id'],
            "usuarioId" => User::query()->first()->id,
            "ativo" => $telephone['ativo'],
        ];
        array_push($data['telefones'], $newTelephone);
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('telephone.edit', ['id' => base64_encode($telephone['id'])]), $data);

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     */
    public function it_endpoint_put_update_base_response_200_edit_provider(): void
    {
        // Arrange
        $data['telefones'] = [];
        $telephone = Telefone::query()->first()->toArray();
        $newTelephone = [
            "numero" => '9' . rand(1000, 2000) . '-' . rand(1000, 2000),
            "tipo" => $telephone['tipo'],
            "dddId" => $telephone['ddd_id'],
            "fornecedorId" => Fornecedor::query()->first()->id,
            "ativo" => $telephone['ativo'],
        ];
        array_push($data['telefones'], $newTelephone);
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('telephone.edit', ['id' => base64_encode($telephone['id'])]), $data);

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     */
    public function it_endpoint_put_update_base_response_400(): void
    {
        // Arrange
        $data['telefones'] = [];
        $telephone = Telefone::query()->first()->toArray();
        $newTelephone = [
            "numero" => '',
            "tipo" => $telephone['tipo'],
            "dddId" => $telephone['ddd_id'],
            "usuarioId" => '',
            "ativo" => $telephone['ativo'],
        ];
        array_push($data['telefones'], $newTelephone);
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('telephone.edit', ['id' => base64_encode($telephone['id'])]), $data);

        // Assert
        $response->assertStatus(400);
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 400);
    }

    /**
     * @test
     */
    public function it_endpoint_put_update_base_response_401(): void
    {
        // Arrange
        $data['telefones'] = [];
        $telephone = Telefone::query()->first()->toArray();
        $newTelephone = [
            "numero" => '9' . rand(1000, 2000) . '-' . rand(1000, 2000),
            "tipo" => $telephone['tipo'],
            "dddId" => $telephone['ddd_id'],
            "usuarioId" => $telephone['usuario_id'],
            "ativo" => $telephone['ativo'],
        ];
        array_push($data['telefones'], $newTelephone);

        // Act
        $response = $this->putJson(route('telephone.edit', ['id' => base64_encode($telephone['id'])]), $data);

        // Assert
        $response->assertUnauthorized();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 401);
    }
}
