<?php

namespace App\Domains\Services\Order\Interfaces;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface IListFindByIdOrderService
{
    public function listFindById(Request $request): Collection;
}
