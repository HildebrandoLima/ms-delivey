<?php

namespace Database\Seeders;

use App\Models\UnidadeFederativa;
use App\Support\Utils\DefaultDatabaseStatic\UnidadesFederativas;
use Illuminate\Database\Seeder;

class UnidadeFederativaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ufs = UnidadesFederativas::UNIDADES_FEDERATIVAS;
        foreach ($ufs as $uf):
            UnidadeFederativa::query()->insert([
                'uf' => $uf['uf'],
                'descricao' => $uf['descricao']
            ]);
        endforeach;
    }
}
