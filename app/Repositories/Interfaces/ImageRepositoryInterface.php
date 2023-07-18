<?php

namespace App\Repositories\Interfaces;

use App\Models\Imagem;

interface ImageRepositoryInterface
{
    public function enableDisable(int $id, int $active): bool;
    public function create(Imagem $imagem): bool;
}
