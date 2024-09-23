<?php

namespace App\Data\Repositories\Category\Concretes;

use App\Data\Repositories\Category\Interfaces\IUpdateCategoryRepository;
use App\Domains\Traits\DefaultConditionActive;
use App\Exceptions\HttpInternalServerError;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Categoria;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;
use Exception;

class UpdateCategoryRepository implements IUpdateCategoryRepository
{
    use DefaultConditionActive;

    public function update(UpdateCategoryRequest $request): bool
    {
        try {
            DB::beginTransaction();
            Categoria::query()
            ->where('id', $request->id)
            ->update([
                'nome' => $request->nome,
                'ativo' => $this->defaultConditionActive($request->ativo)
            ]);
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw new HttpResponseException(HttpInternalServerError::getResponse($e));
        }
    }
}
