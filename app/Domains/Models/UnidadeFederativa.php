<?php

namespace App\Domains\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnidadeFederativa extends Model
{
    use HasFactory;

    protected $table = 'unidade_federativa';

    protected $fillable = [
        'uf',
        'descricao',
    ];
}
