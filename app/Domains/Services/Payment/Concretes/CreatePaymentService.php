<?php

namespace App\Domains\Services\Payment\Concretes;

use App\Data\Repositories\Payment\Interfaces\ICreatePaymentRepository;
use App\Domains\Services\Payment\Interfaces\ICreatePaymentService;
use App\Http\Requests\Payment\CreatePaymentRequest;

class CreatePaymentService implements ICreatePaymentService
{
    private ICreatePaymentRepository $createPaymentRepository;

    public function __construct(ICreatePaymentRepository $createPaymentRepository)
    {
        $this->createPaymentRepository = $createPaymentRepository;
    }

    public function create(CreatePaymentRequest $request): bool
    {
        return $this->createPaymentRepository->create($request);
    }
}
