<?php

namespace App\Domains\Services\Order\Interfaces;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface IListAllOrderService
{
    public function listAll(Request $request): Collection;
}
