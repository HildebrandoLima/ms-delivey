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
     * @group telephone
     */
    public function it_endpoint_post_create_user_base_response_200(): void
    {
        // Arrange
        $randKeys = array_rand($this->type);
        $data = [];
        for ($i = $this->counTelephones; $i <= $this->counTelephones; $i++) {
            $telephone = [
                'ddd' => 85,
                'numero' => '(85)9' . rand(1000, 2000) . '-' . rand(1000, 2000),
                'tipo' => $this->type[$randKeys],
                'usuarioId' => User::query()->first()->id,
            ];
            array_push($data, $telephone);
        }

        // Act
        $response = $this->postJson(route('telephone.save'), $data);

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     * @group telephone
     */
    public function it_endpoint_post_create_provider_base_response_200(): void
    {
        // Arrange
        $randKeys = array_rand($this->type);
        $data = [];
        for ($i = $this->counTelephones; $i <= $this->counTelephones; $i++) {
            $telephone = [
                'ddd' => 85,
                'numero' => '(85)9' . rand(1000, 2000) . '-' . rand(1000, 2000),
                'tipo' => $this->type[$randKeys],
                'fornecedorId' => Fornecedor::query()->first()->id,
            ];
            array_push($data, $telephone);
        }

        // Act
        $response = $this->postJson(route('telephone.save'), $data);

        // Assert
        $response->assertOk();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     * @group telephone
     */
    public function it_endpoint_post_base_response_400(): void
    {
        // Arrange
        $randKeys = array_rand($this->type);
        $data = [];
        for ($i = $this->counTelephones; $i <= $this->counTelephones; $i++) {
            $telephone = [
                'ddd' => 85,
                'numero' => '(85)9' . rand(1000, 2000) . '-' . rand(1000, 2000),
                'tipo' => $this->type[$randKeys],
                'usuarioId' => null,
            ];
            array_push($data, $telephone);
        }

        // Act
        $response = $this->postJson(route('telephone.save'), $data);

        // Assert
        $response->assertStatus(400);
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 400);
    }

    /**
     * @test
     * @group telephone
     */
    public function it_endpoint_post_base_response_404(): void
    {
        // Arrange
        $randKeys = array_rand($this->type);
        $data = [];
        for ($i = $this->counTelephones; $i <= $this->counTelephones; $i++) {
            $telephone = [
                'ddd' => 85,
                'numero' => '(85)9' . rand(1000, 2000) . '-' . rand(1000, 2000),
                'tipo' => $this->type[$randKeys],
                'usuarioId' => 1000,
            ];
            array_push($data, $telephone);
        }

        // Act
        $response = $this->postJson(route('telephone.save'), $data);

        // Assert
        $response->assertNotFound();
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 404);
    }
}
