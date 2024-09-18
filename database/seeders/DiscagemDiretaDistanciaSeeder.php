<?php

namespace Database\Seeders;

use App\Models\DDD;
use App\Support\Utils\DefaultDatabaseStatic\DialingDirectDistanceDb;
use Illuminate\Database\Seeder;

class DiscagemDiretaDistanciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dialingDirectDistanceDb = DialingDirectDistanceDb::DIALING_DIRECT_DISTANCE;
        foreach ($dialingDirectDistanceDb as $value) {
            DDD::query()->insert([
                'ddd' => $value['ddd'],
                'descricao' => $value['descricao'],
                'regiao' => $value['regiao']
            ]);
        }
    }
}
