<?php

namespace Database\Seeders;

use App\Models\MetodoPagamento;
use App\Support\Utils\DefaultDatabaseStatic\MethodPaymentDb;
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
        $methodPaymentDb = MethodPaymentDb::METHOD_PAYMENT;
        foreach ($methodPaymentDb as $instance):
            MetodoPagamento::query()->insert([
                'pagamento' => $instance['pagamento']
            ]);
        endforeach;
    }
}
