<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{
    use HasFactory;

    protected $table = 'pagamento';

    protected $fillable = [
        'codigo_transacao',
        'numero_cartao',
        'tipo_cartao',
        'ccv',
        'data_validade',
        'parcela',
        'total',
        'metodo_pagamento_id',
        'pedido_id',
        'ativo',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' =>'datetime',
    ];
}
