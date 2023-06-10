<?php

namespace Database\Seeders;

use App\Models\Perfil;
use App\Support\Utils\DefaultDatabaseStatic\Perfis;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PerfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $perfis = Perfis::PERFIL;
        foreach ($perfis as $perfil):
            Perfil::query()->insert([
                'perfil' => $perfil['perfil']
            ]);
        endforeach;
    }
}
