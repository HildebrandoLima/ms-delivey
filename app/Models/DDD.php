<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DDD extends Model
{
    use HasFactory;

    protected $table = 'ddd';

    protected $fillable = [
        'ddd',
        'descricao',
    ];
}
