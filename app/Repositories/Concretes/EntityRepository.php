<?php

namespace App\Repositories\Concretes;

use App\Data\Infra\Database\DBConnection;
use App\Exceptions\BaseResponseError;
use App\Repositories\Abstracts\IEntityRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Http\Exceptions\HttpResponseException;
use Throwable;

class EntityRepository extends DBConnection implements IEntityRepository
{
    public function create(Model $model): int
    {
        try {
            $this->db->beginTransaction();
            $id = $model::query()->create($model->toArray())->orderBy('id', 'desc')->first()->id;
            $this->db->commit();
            return $id;
        } catch (Throwable $e) {
            $this->db->rollBack();
            throw new HttpResponseException(BaseResponseError::httpInternalServerErrorException($e));
        }
    }

    public function update(Model $model): bool
    {
        try {
            $this->db->beginTransaction();
            $success = $model::query()->where('id', '=', $model->id)->update($model->toArray());
            $this->db->commit();
            return $success;
        } catch (Throwable $e) {
            $this->db->rollBack();
            throw new HttpResponseException(BaseResponseError::httpInternalServerErrorException($e));
        }
    }

    public function read(Model $model, int $id): Collection
    {
        switch($model->getTable()):
            case 'users':
                return $model::query()
                ->join('endereco as e', 'e.usuario_id', '=', 'users.id')
                ->join('telefone as t', 't.usuario_id', '=', 'users.id')
                ->select(['e.id as enderecoId', 't.id as telefoneId'])->where('users.id', '=', $id)->get();
            break;
            case 'fornecedor':
                return $model::query()
                ->join('endereco as e', 'e.fornecedor_id', '=', 'fornecedor.id')
                ->join('telefone as t', 't.fornecedor_id', '=', 'fornecedor.id')
                ->select(['e.id as enderecoId', 't.id as telefoneId'])->where('fornecedor.id', '=', $id)->get();
            break;
            case 'imagem':
                return $model::query()->select('id')->where('produto_id', '=', $id)->get();
            break;
            case 'item':
                return $model::query()
                ->join('pedido as p', 'p.id', '=', 'item.pedido_id')
                ->select(['item.id as itemId', 'p.id as pedidoId'])
                ->where('p.usuario_id', '=', $id)->orWhere('p.id', '=', $id)->get();
            break;
        endswitch;
    }
}
