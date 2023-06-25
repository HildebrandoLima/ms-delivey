<?php

namespace Database\Seeders;

use App\Models\Telefone;
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
