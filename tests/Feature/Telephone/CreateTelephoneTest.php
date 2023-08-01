<?php

namespace Tests\Feature\Telephone;

use App\Models\Fornecedor;
use App\Models\User;
use Tests\TestCase;

class CreateTelephoneTest extends TestCase
{
    private $counTelephones = 2;
    private array $type = array('Fixo', 'Celular');

    /**
     * @test
     */
    public function it_endpoint_post_create_user_base_response_200(): void
    {
        // Arrange
        $rand_keys = array_rand($this->type);
        $data['telefones'] = [];
        for ($i = $this->counTelephones; $i <= $this->counTelephones; $i++):
            $telephone = [
                'tipo' => $this->type[$rand_keys],
                'numero' => '(' . rand(10, 20) . ')9' . rand(1000, 2000) . '-' . rand(1000, 2000),
                'usuarioId' => User::query()->first()->id,
                'ativo' => true,
            ];
            array_push($data['telefones'], $telephone);
        endfor;

        // Act
        $response = $this->postJson(route('telephone.save'), $data);

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     */
    public function it_endpoint_post_create_provider_base_response_200(): void
    {
        // Arrange
        $rand_keys = array_rand($this->type);
        $data['telefones'] = [];
        for ($i = $this->counTelephones; $i <= $this->counTelephones; $i++):
            $telephone = [
                'tipo' => $this->type[$rand_keys],
                'numero' => '(' . rand(10, 20) . ')9' . rand(1000, 2000) . '-' . rand(1000, 2000),
                'fornecedorId' => Fornecedor::query()->first()->id,
                'ativo' => true,
            ];
            array_push($data['telefones'], $telephone);
        endfor;

        // Act
        $response = $this->postJson(route('telephone.save'), $data);

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     */
    public function it_endpoint_post_base_response_400(): void
    {
        // Arrange
        $rand_keys = array_rand($this->type);
        $data['telefones'] = [];
        for ($i = $this->counTelephones; $i <= $this->counTelephones; $i++):
            $telephone = [
                'tipo' => $this->type[$rand_keys],
                'numero' => '(' . rand(10, 20) . ')9' . rand(1000, 2000) . '-' . rand(1000, 2000),
                'usuarioId' => null,
                'ativo' => true,
            ];
            array_push($data['telefones'], $telephone);
        endfor;

        // Act
        $response = $this->postJson(route('telephone.save'), $data);

        // Assert
        $response->assertStatus(400);
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 400);
    }
}
