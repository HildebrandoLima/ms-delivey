<?php

namespace Tests\Unit\Services\Category;

use App\Http\Requests\Payment\PaymentRequest;
use App\Models\Pagamento;
use App\Models\Pedido;
use App\Repositories\Interfaces\PaymentRepositoryInterface;
use App\Services\Payment\Concretes\CreatePaymentService;
use App\Support\Enums\PerfilEnum;
use Mockery\MockInterface;
use Tests\TestCase;

class CreatePaymentServiceTest extends TestCase
{
    private PaymentRequest $request;
    private PaymentRepositoryInterface $paymentRepository;

    public function test_success_create_payment_service(): void
    {
        // Arrange
        $this->request = new PaymentRequest();
        $this->request['numeroCartao'] = rand(100, 200) . ' ' . rand(100, 200) . ' ' . rand(100, 200) . ' ' . rand(100, 200) . ' ' . rand(100, 200);
        $this->request['dataValidade'] =  date('Y-m-d H:i:s');
        $this->request['parcela'] = rand(0, 2);
        $this->request['total'] = rand(1, 100);
        $this->request['metodoPagamentoId'] = 2;
        $this->request['pedidoId'] = Pedido::factory()->createOne()->id;
        $this->request['ativo'] = true;

        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->paymentRepository = $this->mock(PaymentRepositoryInterface::class,
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
