<?php

namespace Tests\Feature\Telephone;

use App\Models\Telefone;
use App\Support\Utils\Enums\PerfilEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateTelephoneTest extends TestCase
{
    private $count = 2;

    /**
     * @test
     */
    public function it_endpoint_post_base_response_200_create_user(): void
    {
        // Arrange
        $data['telefones'] = [];
        $telephones = Telefone::factory($this->count)->create()->toArray();
        foreach ($telephones as $t){
            $telephone = [
                "numero" => '9' . rand(1000, 2000) . '-' . rand(1000, 2000),
                "tipo" => $t['tipo'],
                "dddId" => $t['ddd_id'],
                "usuarioId" => $t['usuario_id'],
                "ativo" => $t['ativo'],
            ];
            array_push($data['telefones'], $telephone);
        }
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->postJson(route('telephone.save'), $data);

        // Assert
        $this->assertEquals(count($telephones), $this->count);
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     */
    public function it_endpoint_post_base_response_200_create_provider(): void
    {
        // Arrange
        $data['telefones'] = [];
        $telephones = Telefone::factory($this->count)->create()->toArray();
        foreach ($telephones as $t){
            $telephone = [
                "numero" => '9' . rand(1000, 2000) . '-' . rand(1000, 2000),
                "tipo" => $t['tipo'],
                "dddId" => $t['ddd_id'],
                "fornecedorId" => $t['fornecedor_id'],
                "ativo" => $t['ativo'],
            ];
            array_push($data['telefones'], $telephone);
        }
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->postJson(route('telephone.save'), $data);

        // Assert
        $this->assertEquals(count($telephones), $this->count);
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     */
    public function it_endpoint_post_base_response_400(): void
    {
        // Arrange
        $data['telefones'] = [];
        $telephones = Telefone::factory($this->count)->create()->toArray();
        foreach ($telephones as $t){
            $telephone = [
                "numero" => '',
                "tipo" => '',
                "dddId" => $t['ddd_id'],
                "fornecedorId" => $t['fornecedor_id'],
                "ativo" => $t['ativo'],
            ];
            array_push($data['telefones'], $telephone);
        }
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->postJson(route('telephone.save'), $data);

        // Assert
        $this->assertEquals(count($telephones), $this->count);
        $this->assertEquals($this->httpStatusCode($response), 400);
    }

    /**
     * @test
     */
    public function it_endpoint_post_base_response_401(): void
    {
        // Arrange
        $data['telefones'] = [];
        $telephones = Telefone::factory($this->count)->create()->toArray();
        foreach ($telephones as $t){
            $telephone = [
                "numero" => '9' . rand(1000, 2000) . '-' . rand(1000, 2000),
                "tipo" => $t['tipo'],
                "dddId" => $t['ddd_id'],
                "fornecedorId" => $t['fornecedor_id'],
                "ativo" => $t['ativo'],
            ];
            array_push($data['telefones'], $telephone);
        }

        // Act
        $response = $this->postJson(route('telephone.save'), $data);

        // Assert
        $this->assertEquals(count($telephones), $this->count);
        $this->assertEquals($this->httpStatusCode($response), 401);
    }
}
