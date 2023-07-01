<?php

namespace Tests\Feature\User;

use App\Models\Endereco;
use App\Models\Telefone;
use App\Models\User;
use App\Support\Utils\Enums\PerfilEnum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteUserTest extends TestCase
{
    /**
     * @test
     */
    public function it_endpoint_enable_disable_base_response_200(): void
    {
        $data = User::factory()->createOne()->toArray();
        Endereco::factory()->createOne(['usuario_id' => $data['id'], 'fornecedor_id' => null])->toArray();
        Telefone::factory()->createOne(['usuario_id' => $data['id'], 'fornecedor_id' => null])->toArray();

        $authenticate = $this->authenticate(PerfilEnum::ADMIN);
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('user.enable.disable', ['id' => base64_encode($data['id']), 'active' => 0]));
        $this->assertEquals($this->httpStatusCode($response), 200);
    }

    /**
     * @test
     */
    public function it_endpoint_enable_disable_base_response_400(): void
    {
        $data = User::factory()->createOne()->toArray();
        Endereco::factory()->createOne(['usuario_id' => $data['id'], 'fornecedor_id' => null])->toArray();
        Telefone::factory()->createOne(['usuario_id' => $data['id'], 'fornecedor_id' => null])->toArray();

        $authenticate = $this->authenticate(PerfilEnum::ADMIN);
        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ])->putJson(route('user.enable.disable', ['id' => base64_encode($data['id']), 'active' => 1]));
        $this->assertEquals($this->httpStatusCode($response), 400);
    }

    /**
     * @test
     */
    public function it_endpoint_enable_disable_base_response_401(): void
    {
        $data = User::factory()->createOne()->toArray();
        Endereco::factory()->createOne(['usuario_id' => $data['id'], 'fornecedor_id' => null])->toArray();
        Telefone::factory()->createOne(['usuario_id' => $data['id'], 'fornecedor_id' => null])->toArray();

        $response = $this->putJson(route('user.enable.disable', ['id' => base64_encode($data['id']), 'active' => 0]));
        $this->assertEquals($this->httpStatusCode($response), 401);
    }
}
