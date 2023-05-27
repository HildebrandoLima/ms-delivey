<?php

namespace Database\Seeders;

use App\Models\MetodoPagamento;
use App\Support\Utils\DefaultDatabaseStatic\FormaPagamento;
use Illuminate\Database\Seeder;

class MetodoPagamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $metodoPagamento = FormaPagamento::METODO_PAGAMENTO;
        foreach ($metodoPagamento as $value):
            MetodoPagamento::query()->insert([
                'pagamento' => $value['pagamento']
            ]);
        endforeach;
    }
}
