<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    use HasFactory;

    protected $table = 'endereco';

    protected $fillable = [
        'logradouro',
        'descricao',
        'bairro',
        'cidade',
        'cep',
        'uf_id',
        'usuario_id',
        'fornecedor_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' =>'datetime',
    ];
}
