<?php

namespace Tests\Unit\Services\Category;

use App\Http\Requests\Payment\CreatePaymentRequest;
use App\Models\Pagamento;
use App\Repositories\Abstracts\IEntityRepository;
use App\Services\Payment\Concretes\CreatePaymentService;
use App\Support\Enums\PerfilEnum;
use Mockery\MockInterface;
use Tests\TestCase;

class CreatePaymentServiceTest extends TestCase
{
    private CreatePaymentRequest $request;
    private IEntityRepository $paymentRepository;

    public function test_success_create_payment_service(): void
    {
        // Arrange
        $this->request = new CreatePaymentRequest();

        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->paymentRepository = $this->mock(IEntityRepository::class,
        function (MockInterface $mock) {
            $mock->shouldReceive('create')->with(Pagamento::class)->andReturn(true);
        });

        // Act
        $createPaymentService = new CreatePaymentService($this->paymentRepository);

        $result = $createPaymentService->createPayment($this->request);

        // Assert
        $this->assertTrue($result);
    }
}
