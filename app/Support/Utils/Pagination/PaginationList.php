<?php

namespace App\Support\Utils\Pagination;

use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class PaginationList
{
    public static function createFromPagination(Builder $query, Request $request): Collection
    {
        try {
            $total = $query->count();
            $list = $query->offset(($request->perPage - 1) * $request->page)->limit($request->perPage)->get();
            return collect([
                'list' => $list,
                'total' => $total,
                'page' => (int)$request->page,
                'lastPage' => ceil($total / $request->perPage)
            ]);
        } catch(Exception $e) {
            return Log::error('Error ao criar paginação', $e->getMessage());
        }
    }
}
