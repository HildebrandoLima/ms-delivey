<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $table = 'produto';

    protected $fillable = [
        'nome',
        'preco_custo',
        'margem_lucro',
        'preco_venda',
        'codigo_barra',
        'descricao',
        'quantidade',
        'unidade_medida',
        'ativo',
        'data_validade',
        'fornecedor_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' =>'datetime',
    ];
}
