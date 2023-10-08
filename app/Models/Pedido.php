<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedido';

    protected $fillable = [
        'numero_pedido',
        'quantidade_item',
        'total',
        'tipo_entrega',
        'valor_entrega',
        'usuario_id',
        'endereco_id',
        'ativo',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' =>'datetime',
    ];

    public function pagamento(): HasMany
    {
        return $this->hasMany(Pagamento::class, 'pedido_id', 'id');
    }

    public function item(): HasMany
    {
        return $this->hasMany(Item::class, 'pedido_id', 'id');
    }

    public function endereco(): HasMany
    {
        return $this->hasMany(Endereco::class, 'id', 'endereco_id');
    }

    public function usuario(): HasMany
    {
        return $this->hasMany(User::class, 'id', 'usuario_id');
    }
}
