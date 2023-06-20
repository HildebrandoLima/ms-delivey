<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Fornecedor extends Model
{
    use HasFactory;

    protected $table = 'fornecedor';

    protected $fillable = [
        'razao_social',
        'cnpj',
        'email',
        'data_fundacao',
        'ativo',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' =>'datetime',
    ];

    public function endereco(): HasMany
    {
        return $this->hasMany(Endereco::class, 'fornecedor_id', 'id');
    }

    public function telefone(): HasMany
    {
        return $this->hasMany(Telefone::class, 'fornecedor_id', 'id');
    }
}
