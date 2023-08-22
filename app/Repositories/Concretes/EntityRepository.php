<?php

namespace App\Repositories\Concretes;

use App\Repositories\Abstracts\IEntityRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class EntityRepository implements IEntityRepository
{
    public function create(Model $model): int
    {
        return $model::query()->create($model->toArray())->orderBy('id', 'desc')->first()->id;
    }

    public function update(Model $model): bool
    {
        return $model::query()->where('id', '=', $model->id)->update($model->toArray());
    }

    public function read(Model $model, int $id): Collection
    {
        if ($model->getTable() == 'users'):
            return $model::query()->join('endereco as e', 'e.usuario_id', '=', 'users.id')
            ->join('telefone as t', 't.usuario_id', '=', 'users.id')
            ->select(['e.id as enderecoId', 't.id as telefoneId'])->where('users.id', '=', $id)->get();
        endif;
        if ($model->getTable() == 'fornecedor'):
            return $model::query()->join('endereco as e', 'e.fornecedor_id', '=', 'fornecedor.id')
            ->join('telefone as t', 't.fornecedor_id', '=', 'fornecedor.id')
            ->select(['e.id as enderecoId', 't.id as telefoneId'])->where('fornecedor.id', '=', $id)->get();
        endif;
        if ($model->getTable() == 'imagem'):
            return $model::query()->select('id')->where('produto_id', '=', $id)->get();
        endif;
        if ($model->getTable() == 'item'):
            return $model::query()->join('pedido as p', 'p.id', '=', 'item.pedido_id')
            ->select(['item.id as itemId', 'p.id as pedidoId'])
            ->where('p.usuario_id', '=', $id)->orWhere('p.id', '=', $id)->get();
        endif;
    }
}
