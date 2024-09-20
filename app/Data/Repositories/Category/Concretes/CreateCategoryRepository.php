<?php

namespace App\Data\Repositories\Category\Concretes;

use App\Data\Infra\Database\DBConnection;
use App\Data\Repositories\Category\Interfaces\ICreateCategoryRepository;
use App\Domains\Traits\DefaultConditionActive;
use App\Exceptions\HttpInternalServerError;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Models\Categoria;
use Illuminate\Http\Exceptions\HttpResponseException;
use Exception;

class CreateCategoryRepository extends DBConnection implements ICreateCategoryRepository
{
    use DefaultConditionActive;

    public function create(CreateCategoryRequest $request): bool
    {
        try {
            $this->db->beginTransaction();
            Categoria::query()
            ->create([
                'nome' => $request->nome,
                'ativo' => $this->defaultConditionActive(true)
            ]);
            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw new HttpResponseException(HttpInternalServerError::getResponse($e));
        }
    }
}
