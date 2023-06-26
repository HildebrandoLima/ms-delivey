<?php

namespace App\Services\Payment\Concretes;

use App\DataTransferObjects\RequestsDtos\PaymentRequestDto;
use App\Http\Requests\PaymentRequest;
use App\Repositories\Interfaces\PaymentRepositoryInterface;
use App\Services\Payment\Interfaces\CreatePaymentServiceInterface;
use App\Support\Permissions\ValidationPermission;
use App\Support\Utils\Enums\PermissionEnum;

class CreatePaymentService extends ValidationPermission implements CreatePaymentServiceInterface
{
    private PaymentRepositoryInterface $paymentRepository;

    public function __construct(PaymentRepositoryInterface $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    public function createPayment(PaymentRequest $request): bool
    {
        $this->validationPermission(PermissionEnum::CRIAR_PAGAMENTO);
        $payment = PaymentRequestDto::fromRquest($request);
        return $this->paymentRepository->create($payment);
    }
}
