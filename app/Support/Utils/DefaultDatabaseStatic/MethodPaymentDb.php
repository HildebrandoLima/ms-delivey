<?php

namespace App\Support\Utils\DefaultDatabaseStatic;

class MethodPaymentDb
{
    public const METHOD_PAYMENT = [
        [
            'pagamento' => 'Boleto Bancário'
        ],
        [
            'pagamento' => 'Cartão de Crédito'
        ],
        [
            'pagamento' => 'Cartão de Débito'
        ],
        [
            'pagamento' => 'Dinheiro'
        ],
        [
            'pagamento' => 'Pix'
        ],
        [
            'pagamento' => 'Transferência Bancária'
        ],
    ];
}
