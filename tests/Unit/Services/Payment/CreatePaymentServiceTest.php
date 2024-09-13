<?php

namespace Tests\Unit\Services\Category;

use App\Data\Repositories\Abstracts\IEntityRepository;
use App\Domains\Services\Payment\Concretes\CreatePaymentService;
use App\Http\Requests\Payment\CreatePaymentRequest;
use App\Models\Pagamento;
use Mockery\MockInterface;
use Tests\TestCase;

class CreatePaymentServiceTest extends TestCase
{
    private CreatePaymentRequest $request;
    private IEntityRepository $paymentRepository;
    private array $data;

    protected function setUp(): void
    {
        parent::setUp();
        $this->data = $this->setDataPayment();
    }

    public function test_success_create_payment_service(): void
    {
        // Arrange
        $this->request = new CreatePaymentRequest();
        $this->request['numeroCartao'] = $this->data['numeroCartao'];
        $this->request['tipoCartao'] = $this->data['tipoCartao'];
        $this->request['ccv'] = $this->data['ccv'];
        $this->request['dataValidade'] = $this->data['dataValidade'];
        $this->request['parcela'] = $this->data['parcela'];
        $this->request['total'] = $this->data['total'];
        $this->request['metodoPagamento'] = $this->data['metodoPagamento'];
        $this->request['pedidoId'] = $this->data['pedidoId'];

        $this->paymentRepository = $this->mock(IEntityRepository::class,
        function (MockInterface $mock) {
            $mock->shouldReceive('create')->with(Pagamento::class)->andReturn(true);
        });

        // Act
        $createPaymentService = new CreatePaymentService($this->paymentRepository);
        $result = $createPaymentService->createPayment($this->request);
        $mappedPayment = $createPaymentService->map($this->request);

        // Assert
        $this->assertTrue($result);
        $this->assertInstanceOf(Pagamento::class, $mappedPayment);
        $this->assertEquals($this->request['numeroCartao'], $this->data['numeroCartao']);
        $this->assertEquals($this->request['tipoCartao'], $this->data['tipoCartao']);
        $this->assertEquals($this->request['ccv'], $this->data['ccv']);
        $this->assertEquals($this->request['dataValidade'], $this->data['dataValidade']);
        $this->assertEquals($this->request['parcela'], $this->data['parcela']);
        $this->assertEquals($this->request['total'], $this->data['total']);
        $this->assertEquals($this->request['metodoPagamento'], $this->data['metodoPagamento']);
        $this->assertEquals($this->request['pedidoId'], $this->data['pedidoId']);
    }
}
