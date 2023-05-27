<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodoPagamento extends Model
{
    use HasFactory;

    protected $table = 'metodo_pagamento';

    protected $fillable = [
        'pagamento',
    ];
}
