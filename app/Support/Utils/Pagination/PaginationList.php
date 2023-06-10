<?php

namespace App\Support\Utils\Pagination;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Exception;

class PaginationList
{
    public static function createFromPagination(Builder $query): Collection
    {
        try {
            $list = $query->paginate(10);
        } catch(Exception $e) {
            Log::error('Error ao criar paginação', [$e->getMessage()]);
        }
        return collect([
            'list' => $list->items(),
            'total' => $list->total(),
            'page' => $list->currentPage(),
            'lastPage' => $list->lastPage()
        ]);
    }
}
