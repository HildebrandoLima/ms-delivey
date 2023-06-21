<?php

namespace App\Repositories\Interfaces;

use App\DataTransferObjects\Dtos\ImageDto;

interface ImageRepositoryInterface
{
    public function enableDisable(int $id, int $active): bool;
    public function create(ImageDto $imageDto): bool;
}
