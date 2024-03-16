<?php

namespace App\Domains\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'data_validade',
        'categoria_id',
        'fornecedor_id',
        'ativo',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' =>'datetime',
    ];

    public function imagem(): HasMany
    {
        return $this->hasMany(Imagem::class, 'produto_id', 'id');
    }
}
