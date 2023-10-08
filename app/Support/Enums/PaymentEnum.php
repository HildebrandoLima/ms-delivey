<?php

namespace App\Support\Enums;

enum PaymentEnum: string
{
    const BOLETO_BANCARIO = 'Boleto Bancário';
    const CREDITO = 'Crédito';
    const DEBITO = 'Débito';
    const PIX = 'Pix';
}
