<?php

namespace App\Http\Controllers;

use App\Exceptions\SystemDefaultException;
use App\Services\Item\ListItemService;
use App\Support\Utils\Parameters\BaseDecode;
use Symfony\Component\HttpFoundation\Response;

class ItemController extends Controller
{
    private ListItemService $listItemService;

    public function __construct(ListItemService $listItemService)
    {
        $this->listItemService = $listItemService;
    }

    public function index(string $id, BaseDecode $baseDecode): Response
    {
        try {
            $success = $this->listItemService->listItemAll($baseDecode->baseDecode($id));
            if (!$success) return Controller::error();
            return Controller::get($success);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }
}
