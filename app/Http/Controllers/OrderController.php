<?php

namespace App\Http\Controllers;

use App\Exceptions\SystemDefaultException;
use App\Http\Requests\Order\CreateOrderRequest;
use App\Http\Requests\Order\ParamsOrderRequest;
use App\Http\Requests\User\ParamsUserRequest;
use App\Services\Order\Abstracts\ICreateOrderService;
use App\Services\Order\Abstracts\IEditOrderService;
use App\Services\Order\Abstracts\IListOrderService;
use App\Support\Utils\Params\FilterByActive;
use App\Support\Utils\Params\Search;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    private ICreateOrderService $createOrderService;
    private IEditOrderService   $editOrderService;
    private IListOrderService   $listOrderService;

    public function __construct
    (
        ICreateOrderService $createOrderService,
        IEditOrderService   $editOrderService,
        IListOrderService   $listOrderService
    )
    {
        $this->createOrderService = $createOrderService;
        $this->editOrderService   = $editOrderService;
        $this->listOrderService   = $listOrderService;
    }

    public function index(Search $search, ParamsUserRequest $request, FilterByActive $filter): Response
    {
        try {
            $success = $this->listOrderService->listOrderAll
            (
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

    public function update(ParamsOrderRequest $request): Response
    {
        try {
            $success = $this->editOrderService->editOrder($request);
            if (!$success) return Controller::error();
            return Controller::put();
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }
}
