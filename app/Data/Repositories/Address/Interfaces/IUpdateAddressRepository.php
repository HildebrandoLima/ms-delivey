<?php

namespace App\Data\Repositories\Address\Interfaces;

use Illuminate\Http\Request;

interface IUpdateAddressRepository
{
    public function update(Request $request): bool;
}
