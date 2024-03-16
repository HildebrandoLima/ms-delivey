<?php

namespace Database\Seeders;

use App\Domains\Models\DDD;
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
        foreach ($dialingDirectDistanceDb as $instance):
            DDD::query()->insert([
                'ddd' => $instance['ddd'],
                'descricao' => $instance['descricao'],
                'regiao' => $instance['regiao']
            ]);
        endforeach;
    }
}
