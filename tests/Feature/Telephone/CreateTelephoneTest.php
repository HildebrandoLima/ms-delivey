<?php

namespace Tests\Feature\Telephone;

use App\Models\User;
use App\Support\Utils\Enums\PerfilEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateTelephoneTest extends TestCase
{
    private $counTelephones = 2;
    private array $type = array('Fixo', 'Celular');

    /**
     * @test
     */
    public function it_endpoint_post_base_response_200_create_user(): void
    {
        // Arrange
        $rand_keys = array_rand($this->type);
        $data['telefones'] = [];
        for ($i = $this->counTelephones; $i <= $this->counTelephones; $i++):
            $telephone = [
                "numero" => '9' . rand(1000, 2000) . '-' . rand(1000, 2000),
                "tipo" => $this->type[$rand_keys],
                "dddId" => rand(70, 92),
                "usuarioId" => User::query()->first()->id,
                "ativo" => true,
            ];
            array_push($data['telefones'], $telephone);
        endfor;
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->postJson(route('telephone.save'), $data);

        // Assert
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     */
    public function it_endpoint_post_base_response_200_create_provider(): void
    {
        // Arrange
        $rand_keys = array_rand($this->type);
        $data['telefones'] = [];
        for ($i = $this->counTelephones; $i <= $this->counTelephones; $i++):
            $telephone = [
                "numero" => '9' . rand(1000, 2000) . '-' . rand(1000, 2000),
                "tipo" => $this->type[$rand_keys],
                "dddId" => rand(70, 92),
                "usuarioId" => User::query()->first()->id,
                "ativo" => true,
            ];
            array_push($data['telefones'], $telephone);
        endfor;
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->postJson(route('telephone.save'), $data);

        // Assert
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
                "numero" => '9' . rand(1000, 2000) . '-' . rand(1000, 2000),
                "tipo" => $this->type[$rand_keys],
                "dddId" => rand(70, 92),
                "usuarioId" => '',
                "ativo" => true,
            ];
            array_push($data['telefones'], $telephone);
        endfor;
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->postJson(route('telephone.save'), $data);

        // Assert
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 400);
    }

    /**
     * @test
     */
    public function it_endpoint_post_base_response_401(): void
    {
        // Arrange
        $rand_keys = array_rand($this->type);
        $data['telefones'] = [];
        for ($i = $this->counTelephones; $i <= $this->counTelephones; $i++):
            $telephone = [
                "numero" => '9' . rand(1000, 2000) . '-' . rand(1000, 2000),
                "tipo" => $this->type[$rand_keys],
                "dddId" => rand(70, 92),
                "usuarioId" => User::query()->first()->id,
                "ativo" => true,
            ];
            array_push($data['telefones'], $telephone);
        endfor;

        // Act
        $response = $this->postJson(route('telephone.save'), $data);

        // Assert
        $this->assertJson($this->baseResponse($response));
        $this->assertEquals($this->httpStatusCode($response), 401);
    }
}
