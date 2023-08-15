<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\Models\Endereco;
use App\Models\Fornecedor;
use App\Models\Imagem;
use App\Models\Item;
use App\Models\Pagamento;
use App\Models\Pedido;
use App\Models\Produto;
use App\Models\Telefone;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SetupTest extends TestCase
{
    private int $count = 10;

    /**
     * @test
     */
    public function it_create_case_test(): void
    {
        $user = User::factory($this->count)->create(['email' => 'cliente@gmail.com', 'password' => '@PClient5']);

        $provider = Fornecedor::factory($this->count)->create();

        Telefone::factory(2)->create(['usuario_id' => $user[0]['id']]);

        Telefone::factory(2)->create(['usuario_id' => $provider[0]['id']]);

        Endereco::factory(['usuario_id' => $user[0]['id']])->createOne();

        Endereco::factory(['usuario_id' => $provider[0]['id']])->createOne();

        $product = Produto::factory($this->count)->create();

        Imagem::factory()->create(['produto_id' => $product[0]['id']]);

        Categoria::factory($this->count)->create();

        $order = Pedido::factory()->createOne();

        Item::factory()->create(['pedido_id' => $order['id']]);

        Pagamento::factory()->createOne(['pedido_id' => $order['id']]);
    }
}
