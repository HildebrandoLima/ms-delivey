<?php

namespace App\Http\Controllers;

use App\Domains\Services\Order\Interfaces\ICreateOrderService;
use App\Domains\Services\Order\Interfaces\IListAllOrderService;
use App\Domains\Services\Order\Interfaces\IListFindByIdOrderService;
use App\Domains\Services\Order\Interfaces\IUpdateOrderService;
use App\Http\Requests\Order\CreateOrderRequest;
use App\Http\Requests\Order\ListAllOrderRequest;
use App\Http\Requests\Order\ListFindByIdOrderRequest;
use Symfony\Component\HttpFoundation\Response;
use Exception;

class OrderController extends Controller
{
    private ICreateOrderService       $createOrderService;
    private IListAllOrderService      $listAllOrderService;
    private IListFindByIdOrderService $listFindByIdOrderService;
    private IUpdateOrderService       $updateOrderService;

    public function __construct
    (
        ICreateOrderService       $createOrderService,
        IListAllOrderService      $listAllOrderService,
        IListFindByIdOrderService $listFindByIdOrderService,
        IUpdateOrderService       $updateOrderService
    )
    {
        $this->createOrderService       = $createOrderService;
        $this->listAllOrderService      = $listAllOrderService;
        $this->listFindByIdOrderService = $listFindByIdOrderService;
        $this->updateOrderService       = $updateOrderService;
    }

    public function index(ListAllOrderRequest $request): Response
    {
        try {
            $success = $this->listAllOrderService->listAll($request);
            return Controller::get($success);
        } catch (Exception $e) {
            return Controller::error($e);
        }
    }

    public function show(ListFindByIdOrderRequest $request): Response
    {
        try {
            $success = $this->listFindByIdOrderService->listFindById($request);
            return Controller::get($success);
        } catch (Exception $e) {
            return Controller::error($e);
        }
    }

    public function store(CreateOrderRequest $request): Response
    {
        try {
            $success = $this->createOrderService->create($request);
            return Controller::post($success);
        } catch (Exception $e) {
            return Controller::error($e);
        }
    }

    public function update(ListFindByIdOrderRequest $request): Response
    {
        try {
            $success = $this->updateOrderService->update($request);
            return Controller::put($success);
        } catch (Exception $e) {
            return Controller::error($e);
        }
    }
}
