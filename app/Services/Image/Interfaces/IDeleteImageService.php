<?php

namespace App\Services\Image\Interfaces;

interface IDeleteImageService
{
    public function deleteImage(int $id): bool;
}
