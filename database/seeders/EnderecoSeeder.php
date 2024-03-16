<?php

namespace Database\Seeders;

use App\Models\Endereco;
use Illuminate\Database\Seeder;

class EnderecoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Endereco::factory()->create();
    }
}
