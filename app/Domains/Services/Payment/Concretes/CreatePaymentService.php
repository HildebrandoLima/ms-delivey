<?php

namespace App\Domains\Services\Payment\Concretes;

use App\Data\Repositories\Payment\Interfaces\ICreatePaymentRepository;
use App\Domains\Services\Payment\Interfaces\ICreatePaymentService;
use App\Domains\Traits\RequestConfigurator;
use App\Http\Requests\Payment\CreatePaymentRequest;

class CreatePaymentService implements ICreatePaymentService
{
    use RequestConfigurator;
    private ICreatePaymentRepository $createPaymentRepository;

    public function __construct(ICreatePaymentRepository $createPaymentRepository)
    {
        $this->createPaymentRepository = $createPaymentRepository;
    }

    public function create(CreatePaymentRequest $request): bool
    {
        $this->setRequest($request);
        return $this->created();
    }

    public function created(): bool
    {
        return $this->createPaymentRepository->create($this->request);
    }
}
