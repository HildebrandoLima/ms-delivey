<?php

namespace App\Domains\Services\Order\Abstracts;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface IListOrderService
{
    public function listOrderAll(Request $request): Collection;
    public function listOrderFind(Request $request): Collection;
}
