<?php

namespace Database\Seeders;

use App\Models\DDD;
use App\Support\Utils\DiscagemDiretaDistancia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $ddds = DiscagemDiretaDistancia::DISCAGEM_DIRETA_DISTANCIA;
        foreach ($ddds as $ddd):
            DDD::query()->insert([
                'ddd' => $ddd['ddd'],
                'descricao' => $ddd['descricao'],
                'regiao' => $ddd['regiao']
            ]);
        endforeach;
    }
}
