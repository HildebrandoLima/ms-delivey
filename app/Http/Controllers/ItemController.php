<?php

namespace App\Http\Controllers;

use App\Exceptions\SystemDefaultException;
use App\Http\Requests\ParametersRequest;
use App\Services\Item\ListItemService;
use App\Support\Utils\Parameters\BaseDecode;
use App\Support\Utils\Parameters\FilterByActive;
use Symfony\Component\HttpFoundation\Response;

class ItemController extends Controller
{
    private ListItemService $listItemService;

    public function __construct(ListItemService $listItemService)
    {
        $this->listItemService = $listItemService;
    }

    public function index(ParametersRequest $request, BaseDecode $baseDecode, FilterByActive $filterByActive): Response
    {
        try {
            $success = $this->listItemService->listItemAll
            (
                $baseDecode->baseDecode($request->id),
                $filterByActive->filterByActive($request->active)
            );
            if (!$success) return Controller::error();
            return Controller::get($success);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }
}
