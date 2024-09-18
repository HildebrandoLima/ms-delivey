<?php

namespace App\Http\Controllers;

use App\Domains\Services\Order\Abstracts\ICreateOrderService;
use App\Domains\Services\Order\Abstracts\IEditOrderService;
use App\Domains\Services\Order\Abstracts\IListOrderService;
use App\Http\Requests\Order\CreateOrderRequest;
use App\Http\Requests\Order\ParamsOrderRequest;
use App\Http\Requests\User\ParamsUserRequest;
use Symfony\Component\HttpFoundation\Response;
use Exception;

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

    public function index(ParamsUserRequest $request): Response
    {
        try {
            $success = $this->listOrderService->listOrderAll($request);
            return Controller::get($success);
        } catch (Exception $e) {
            return Controller::error($e);
        }
    }

    public function show(ParamsOrderRequest $request): Response
    {
        try {
            $success = $this->listOrderService->listOrderFind($request);
            return Controller::get($success);
        } catch (Exception $e) {
            return Controller::error($e);
        }
    }

    public function store(CreateOrderRequest $request): Response
    {
        try {
            $success = $this->createOrderService->createOrder($request);
            return Controller::post($success);
        } catch (Exception $e) {
            return Controller::error($e);
        }
    }

    public function update(ParamsOrderRequest $request): Response
    {
        try {
            $success = $this->editOrderService->editOrder($request);
            return Controller::put($success);
        } catch (Exception $e) {
            return Controller::error($e);
        }
    }
}
