<?php

namespace App\Http\Controllers;

use App\Exceptions\SystemDefaultException;
use App\Services\Image\ListImageService;
use App\Support\Utils\Parameters\BaseDecode;
use Symfony\Component\HttpFoundation\Response;

class ImageController extends Controller
{
    private ListImageService $listImageService;

    public function __construct(ListImageService $listImageService)
    {
        $this->listImageService = $listImageService;
    }

    public function index(string $id, BaseDecode $baseDecode): Response
    {
        try {
            $success = $this->listImageService->listImageAll($baseDecode->baseDecode($id));
            if (!$success) return Controller::error();
            return Controller::get($success);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }
}
