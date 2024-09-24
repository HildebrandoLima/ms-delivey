<?php

namespace App\Data\Repositories\Category\Concretes;

use App\Data\Repositories\Category\Interfaces\ICreateCategoryRepository;
use App\Domains\Traits\DefaultConditionActive;
use App\Exceptions\HttpInternalServerError;
use App\Http\Requests\Category\CreateCategoryRequest;
use App\Models\Categoria;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;
use Exception;

class CreateCategoryRepository implements ICreateCategoryRepository
{
    use DefaultConditionActive;

    public function create(CreateCategoryRequest $request): bool
    {
        try {
            DB::beginTransaction();
            Categoria::query()
            ->create([
                'nome' => $request->nome,
                'ativo' => $this->defaultConditionActive(true)
            ]);
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw new HttpResponseException(HttpInternalServerError::getResponse($e));
        }
    }
}
