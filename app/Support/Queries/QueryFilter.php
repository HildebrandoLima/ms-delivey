<?php

namespace App\Support\Queries;

use App\Support\Enums\AtivoEnum;
use Illuminate\Database\Eloquent\Builder;

class QueryFilter
{
    final public static function getQueryFilter(Builder $query)
    {
        return $query->where($query->from . '.ativo', '=', AtivoEnum::ATIVADO);
    }
}
