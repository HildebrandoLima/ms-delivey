<?php

namespace App\Services\Payment\Concretes;

use App\DataTransferObjects\RequestsDtos\PaymentRequestDto;
use App\Http\Requests\PaymentRequest;
use App\Repositories\Interfaces\PaymentRepositoryInterface;
use App\Services\Payment\Interfaces\CreatePaymentServiceInterface;

class CreatePaymentService implements CreatePaymentServiceInterface
{
    private PaymentRepositoryInterface $paymentRepository;

    public function __construct(PaymentRepositoryInterface $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    public function createPayment(PaymentRequest $request): bool
    {
        $payment = PaymentRequestDto::fromRquest($request);
        return $this->paymentRepository->create($payment);
    }
}
