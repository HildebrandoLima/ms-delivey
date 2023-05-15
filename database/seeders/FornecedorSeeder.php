<?php

namespace Database\Seeders;

use App\Models\Fornecedor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class FornecedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = Fornecedor::all()->count();
        if ($count > 0):
            Fornecedor::factory()->create();
        else:
            Fornecedor::query()->insert([
                'nome' => 'Desativado',
                'cnpj' => Str::random(14),
                'email' => 'email@email.com.br',
                'ativo' => 0,
                'data_fundacao' => new \dateTime(),
            ]);
        endif;
    }
}
