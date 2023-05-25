<?php

namespace App\Services\Image;

use App\Repositories\CheckRegisterRepository;
use App\Repositories\ImageRepository;
use App\Services\Image\Interfaces\IDeleteImageService;

class DeleteImageService implements IDeleteImageService
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

    public function deleteImage(int $id): bool
    {
        $this->checkRegisterRepository->checkImageIdExist($id);
        return $this->imageRepository->delete($id);
    }
}
