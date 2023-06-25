<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CategoriaSeeder::class,
            EnderecoSeeder::class,
            FornecedorSeeder::class,
            PagamentoSeeder::class,
            PedidoSeeder::class,
            ProdutoSeeder::class,
            TelefoneSeeder::class,
            UserSeeder::class,
        ]);
    }
}
