<?php

namespace Tests\Feature\Telephone;

use App\Models\Telefone;
use App\Support\Utils\Enums\PerfilEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateTelephoneTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_post_base_response_200(): void
    {
        // Arrange
        $telephone = Telefone::factory(1)->make()->toArray();
        $data['telefones'] = [
            'numero' => $telephone[0]['numero'],
            'tipo' => $telephone[0]['tipo'],
            'dddId' => $telephone[0]['ddd_id'],
            'usuarioId' => $telephone[0]['usuario_id'],
            'fornecedorId' => $telephone[0]['fornecedor_id'],
            'ativo' => $telephone[0]['ativo'],
        ];
        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        // Act
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->postJson(route('telephone.save'), $data);
        dd($response);

        // Assert     
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     */
    public function it_endpoint_post_base_response_400(): void
    {
        //
    }

    /**
     * @test
     */
    public function it_endpoint_post_base_response_401(): void
    {
        //
    }
}
