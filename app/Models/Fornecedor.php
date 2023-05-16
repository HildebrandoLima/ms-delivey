<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    use HasFactory;

    protected $table = 'fornecedor';

    protected $fillable = [
        'nome',
        'cnpj',
        'email',
        'ativo',
        'data_fundacao',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' =>'datetime',
    ];
}
