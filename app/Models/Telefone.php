<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telefone extends Model
{
    use HasFactory;

    protected $table = 'telefone';

    protected $fillable = [
        'numero',
        'tipo',
        'usuario_id',
        'fornecedor_id',
        'ativo',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' =>'datetime',
    ];
}
