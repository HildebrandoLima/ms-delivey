<?php

namespace App\Data\Repositories\Category\Concretes;

use App\Data\Infra\Database\DBConnection;
use App\Data\Repositories\Category\Interfaces\IUpdateCategoryRepository;
use App\Domains\Traits\DefaultConditionActive;
use App\Exceptions\HttpInternalServerError;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Categoria;
use Illuminate\Http\Exceptions\HttpResponseException;
use Exception;

class UpdateCategoryRepository extends DBConnection implements IUpdateCategoryRepository
{
    use DefaultConditionActive;

    public function update(UpdateCategoryRequest $request): bool
    {
        try {
            $this->db->beginTransaction();
            Categoria::query()
            ->where('id', $request->id)
            ->update([
                'nome' => $request->nome,
                'ativo' => $this->defaultConditionActive($request->ativo)
            ]);
            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw new HttpResponseException(HttpInternalServerError::getResponse($e));
        }
    }
}
