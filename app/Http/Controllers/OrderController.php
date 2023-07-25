<?php

namespace App\Http\Controllers;

use App\Exceptions\SystemDefaultException;
use App\Http\Requests\Order\OrderRequest;
use App\Http\Requests\ParametersRequest;
use App\Services\Order\Interfaces\CreateOrderServiceInterface;
use App\Services\Order\Interfaces\DeleteOrderServiceInterface;
use App\Services\Order\Interfaces\ListOrderServiceInterface;
use App\Support\Utils\Parameters\BaseDecode;
use App\Support\Utils\Parameters\FilterByActive;
use App\Support\Utils\Parameters\Search;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    private CreateOrderServiceInterface $createOrderService;
    private DeleteOrderServiceInterface $deleteOrderService;
    private ListOrderServiceInterface   $listOrderService;

    public function __construct
    (
        CreateOrderServiceInterface $createOrderService,
        DeleteOrderServiceInterface $deleteOrderService,
        ListOrderServiceInterface   $listOrderService
    )
    {
        $this->createOrderService = $createOrderService;
        $this->deleteOrderService = $deleteOrderService;
        $this->listOrderService   = $listOrderService;
    }

    public function index(ParametersRequest $request, BaseDecode $baseDecode, FilterByActive $filterByActive): Response
    {
        try {
            $success = $this->listOrderService->listOrderAll
            (
                $baseDecode::baseDecode($request->id ?? ''),
                $filterByActive::filterByActive($request->active)
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
                $baseDecode::baseDecode($request->id ?? ''),
                $search::search($request->search ?? ''),
                $filterByActive::filterByActive($request->active)
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

    public function enableDisable(ParametersRequest $request, BaseDecode $baseDecode, FilterByActive $filterByActive): Response
    {
        try {
            $success = $this->deleteOrderService->deleteOrder
            (
                $baseDecode::baseDecode($request->id),
                $filterByActive::filterByActive($request->active)
            );
            if (!$success) return Controller::error();
            return Controller::delete();
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }
}
