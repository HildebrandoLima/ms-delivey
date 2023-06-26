<?php

namespace Database\Seeders;

use App\Models\UnidadeFederativa;
use App\Support\Utils\DefaultDatabaseStatic\UnitFederalDb;
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
        $unitFederalDb = UnitFederalDb::UNIT_FEDERAL;
        foreach ($unitFederalDb as $instance):
            UnidadeFederativa::query()->insert([
                'uf' => $instance['uf'],
                'descricao' => $instance['descricao']
            ]);
        endforeach;
    }
}
