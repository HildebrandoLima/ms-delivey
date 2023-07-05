<?php

namespace Tests\Feature\Telephone;

use App\Models\Telefone;
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
        $telephones = Telefone::factory(1)->create()->toArray();
        foreach ($telephones as $t):
            $telephone = [
                "numero" => '9' . rand(1000, 2000) . '-' . rand(1000, 2000),
                "tipo" => $t['tipo'],
                "dddId" => $t['ddd_id'],
                "usuarioId" => $t['usuario_id'],
                "ativo" => $t['ativo'],
            ];
            array_push($data['telefones'], $telephone);
        endforeach;
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('telephone.edit', ['id' => base64_encode($telephones[0]['id'])]), $data);

        // Assert
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     */
    public function it_endpoint_put_update_base_response_200_edit_provider(): void
    {
        // Arrange
        $data['telefones'] = [];
        $telephones = Telefone::factory(1)->create()->toArray();
        foreach ($telephones as $t):
            $telephone = [
                "numero" => '9' . rand(1000, 2000) . '-' . rand(1000, 2000),
                "tipo" => $t['tipo'],
                "dddId" => $t['ddd_id'],
                "usuarioId" => $t['usuario_id'],
                "ativo" => $t['ativo'],
            ];
            array_push($data['telefones'], $telephone);
        endforeach;
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('telephone.edit', ['id' => base64_encode($telephones[0]['id'])]), $data);

        // Assert
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     */
    public function it_endpoint_put_update_base_response_400(): void
    {
        // Arrange
        $data['telefones'] = [];
        $telephones = Telefone::factory(1)->create()->toArray();
        foreach ($telephones as $t):
            $telephone = [
                "numero" => '',
                "tipo" => $t['tipo'],
                "dddId" => $t['ddd_id'],
                "usuarioId" => $t['usuario_id'],
                "ativo" => $t['ativo'],
            ];
            array_push($data['telefones'], $telephone);
        endforeach;
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('telephone.edit', ['id' => base64_encode($telephones[0]['id'])]), $data);

        // Assert
        $this->assertEquals($this->httpStatusCode($response), 400);
    }

    /**
     * @test
     */
    public function it_endpoint_put_update_base_response_401(): void
    {
        // Arrange
        $data['telefones'] = [];
        $telephones = Telefone::factory(1)->create()->toArray();
        foreach ($telephones as $t):
            $telephone = [
                "numero" => '9' . rand(1000, 2000) . '-' . rand(1000, 2000),
                "tipo" => $t['tipo'],
                "dddId" => $t['ddd_id'],
                "usuarioId" => $t['usuario_id'],
                "ativo" => $t['ativo'],
            ];
            array_push($data['telefones'], $telephone);
        endforeach;

        // Act
        $response = $this->putJson(route('telephone.edit', ['id' => base64_encode($telephones[0]['id'])]), $data);

        // Assert
        $this->assertEquals($this->httpStatusCode($response), 401);
    }
}
