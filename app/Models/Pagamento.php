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
        'data_credito',
        'parcela',
        'total',
        'ativo',
        'metodo_pagamento_id',
        'pedido_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' =>'datetime',
    ];
}
