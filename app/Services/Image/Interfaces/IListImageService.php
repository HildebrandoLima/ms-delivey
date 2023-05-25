<?php

namespace App\Services\Image\Interfaces;

use Illuminate\Support\Collection;

interface IListImageService
{
    public function listImageAll(int $id): Collection;
}
