<?php

namespace App\Support\Utils\DefaultDatabaseStatic;

class FormaPagamento
{
    public const METODO_PAGAMENTO = [
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
