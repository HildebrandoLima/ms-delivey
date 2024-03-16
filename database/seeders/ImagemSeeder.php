<?php

namespace Database\Seeders;

use App\Domains\Models\Imagem;
use Illuminate\Database\Seeder;

class ImagemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Imagem::factory()->create();
    }
}
