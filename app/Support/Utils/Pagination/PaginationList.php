<?php

namespace App\Support\Utils\Pagination;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Pagination\LengthAwarePaginator;
use Exception;

class PaginationList
{
    public static function createFromPagination(LengthAwarePaginator $paginator): Collection
    {
        try {
            return collect([
                'list' => $paginator->items(),
                'total' => $paginator->total(),
                'page' => $paginator->currentPage(),
                'lastPage' => $paginator->lastPage()
            ]);
        } catch (Exception $e) {
            Log::error('Error ao criar paginação', [$e->getMessage()]);
        }
    }
}
