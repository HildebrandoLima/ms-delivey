<?php

namespace App\Support\Queries;

use App\Support\Enums\ActiveEnum;
use Illuminate\Database\Eloquent\Builder;

final class QueryFilter
{
    final public static function getQueryFilter(Builder $query, bool $filter)
    {
        return $query->where($query->from . '.ativo', '=',
        $filter == true ? ActiveEnum::ATIVADO : ActiveEnum::DESATIVADO);
    }
}
