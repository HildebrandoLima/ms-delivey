<?php

namespace Database\Seeders;

use App\Domains\Models\Telefone;
use Illuminate\Database\Seeder;

class TelefoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Telefone::factory()->create();
    }
}
