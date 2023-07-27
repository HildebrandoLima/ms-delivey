<?php

namespace App\Http\Controllers;

use App\Exceptions\SystemDefaultException;
use App\Http\Requests\Order\CreateOrderRequest;
use App\Http\Requests\Order\ParamsOrderRequest;
use App\Http\Requests\User\ParamsUserRequest;
use App\Services\Order\Interfaces\CreateOrderServiceInterface;
use App\Services\Order\Interfaces\DeleteOrderServiceInterface;
use App\Services\Order\Interfaces\ListOrderServiceInterface;
use App\Support\Utils\Pagination\Pagination;
use App\Support\Utils\Params\FilterByActive;
use App\Support\Utils\Params\Search;
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

    public function index(Pagination $pagination, Search $search, ParamsUserRequest $request, FilterByActive $filter): Response
    {
        try {
            $success = $this->listOrderService->listOrderAll
            (
                $pagination,
                $search->search(request()),
                $request->id,
                $filter->active
            );
            if (!$success) return Controller::error();
            return Controller::get($success);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function show(ParamsOrderRequest $request, FilterByActive $filter): Response
    {
        try {
            $success = $this->listOrderService->listOrderFind
            (
                $request->id,
                $filter->active
            );
            if (!$success) return Controller::error();
            return Controller::get($success);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function store(CreateOrderRequest $request): Response
    {
        try {
            $success = $this->createOrderService->createOrder($request);
            if (!$success) return Controller::error();
            return Controller::post($success);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function enableDisable(ParamsOrderRequest $request, FilterByActive $filter): Response
    {
        try {
            $success = $this->deleteOrderService->deleteOrder
            (
                $request->id,
                $filter->active
            );
            if (!$success) return Controller::error();
            return Controller::delete();
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }
}
