<?php

namespace Database\Seeders;

use App\Models\Pagamento;
use Illuminate\Database\Seeder;

class PagamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pagamento::factory()->create();
    }
}
