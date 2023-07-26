<?php

namespace App\Repositories\Interfaces;

use App\Models\Imagem;

interface ImageRepositoryInterface
{
    public function enableDisable(int $id, bool $active): bool;
    public function create(Imagem $imagem): bool;
}
