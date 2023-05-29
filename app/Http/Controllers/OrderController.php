<?php

namespace App\Http\Controllers;

use App\Exceptions\SystemDefaultException;
use App\Http\Requests\OrderRequest;
use App\Http\Requests\ParametersRequest;
use App\Services\Order\CreateOrderService;
use App\Services\Order\DeleteOrderService;
use App\Services\Order\ListOrderService;
use App\Support\Utils\Pagination\Pagination;
use App\Support\Utils\Parameters\BaseDecode;
use App\Support\Utils\Parameters\FilterByActive;
use App\Support\Utils\Parameters\Search;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    private CreateOrderService $createOrderService;
    private DeleteOrderService $deleteOrderService;
    private ListOrderService   $listOrderService;

    public function __construct
    (
        CreateOrderService $createOrderService,
        DeleteOrderService $deleteOrderService,
        ListOrderService   $listOrderService
    )
    {
        $this->createOrderService = $createOrderService;
        $this->deleteOrderService = $deleteOrderService;
        $this->listOrderService   = $listOrderService;
    }

    public function index(Pagination $pagination, FilterByActive $filterByActive): Response
    {
        try {
            $success = $this->listOrderService->listOrderAll
            (
                $pagination,
                $filterByActive->filterByActive($pagination->active)
            );
            if (!$success) return Controller::error();
            return Controller::get($success);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function show(ParametersRequest $request, BaseDecode $baseDecode, Search $search, FilterByActive $filterByActive): Response
    {
        try {
            $success = $this->listOrderService->listOrderFind
            (
                $baseDecode->baseDecode($request->id ?? ''),
                $search->search($request->search ?? ''),
                $filterByActive->filterByActive($request->active)
            );
            if (!$success) return Controller::error();
            return Controller::get($success);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function store(OrderRequest $request): Response
    {
        try {
            $success = $this->createOrderService->createOrder($request);
            if (!$success) return Controller::error();
            return Controller::post($success);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function destroy(string $id, BaseDecode $baseDecode): Response
    {
        try {
            $success = $this->deleteOrderService->deleteOrder($baseDecode->baseDecode($id));
            if (!$success) return Controller::error();
            return Controller::delete();
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }
}
