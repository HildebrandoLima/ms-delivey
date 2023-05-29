<?php

namespace App\Services\Image;

use App\Repositories\CheckRegisterRepository;
use App\Repositories\ImageRepository;
use App\Services\Image\Interfaces\IListImageService;
use Illuminate\Support\Collection;

class ListImageService implements IListImageService
{
    private CheckRegisterRepository $checkRegisterRepository;
    private ImageRepository $imageRepository;

    public function __construct
    (
        CheckRegisterRepository $checkRegisterRepository,
        ImageRepository         $imageRepository
    )
    {
        $this->checkRegisterRepository = $checkRegisterRepository;
        $this->imageRepository         = $imageRepository;
    }

    public function listImageAll(int $id, int $active): Collection
    {
        $this->checkRegisterRepository->checkProductIdExist($id);
        return $this->imageRepository->getAll($id, $active);
    }
}
