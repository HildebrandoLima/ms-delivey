<?php

namespace App\Domains\Services\Payment\Concretes;

use App\Data\Repositories\Payment\Interfaces\ICreatePaymentRepository;
use App\Domains\Services\Payment\Interfaces\ICreatePaymentService;
use App\Http\Requests\Payment\CreatePaymentRequest;

class CreatePaymentService implements ICreatePaymentService
{
    private ICreatePaymentRepository $createPaymentRepository;
    private CreatePaymentRequest $request;

    public function __construct(ICreatePaymentRepository $createPaymentRepository)
    {
        $this->createPaymentRepository = $createPaymentRepository;
    }

    public function create(CreatePaymentRequest $request): bool
    {
        $this->setRequest($request);
        return $this->created();
    }

    private function setRequest(CreatePaymentRequest $request): void
    {
        $this->request = $request;
    }

    public function created(): bool
    {
        return $this->createPaymentRepository->create($this->request);
    }
}
