<?php

namespace App\Support\Utils\Pagination;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Exception;

class PaginationList
{
    public static function createFromPagination(Builder $query, Pagination $pagination): Collection
    {
        try {
            $total = $query->count();
            $list = $query->offset(($pagination->perPage - 1) * $pagination->page)->limit($pagination->perPage)->get();
            return collect([
                'list' => $list,
                'total' => $total,
                'page' => (int)$pagination->page,
                'lastPage' => ceil($total / $pagination->perPage)
            ]);
        } catch(Exception $e) {
            return Log::error('Error ao criar paginação', $e->getMessage());
        }
    }
}
