<?php

namespace Tests\Unit\Services\Category;

use App\Data\Repositories\Payment\Interfaces\ICreatePaymentRepository;
use App\Domains\Services\Payment\Concretes\CreatePaymentService;
use App\Http\Requests\Payment\CreatePaymentRequest;
use Mockery\MockInterface;
use Tests\TestCase;

class CreatePaymentServiceTest extends TestCase
{
    private CreatePaymentRequest $request;
    private ICreatePaymentRepository $createPaymentRepository;
    private array $data = [];

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

        $this->createPaymentRepository = $this->mock(ICreatePaymentRepository::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('create')
                     ->with($this->request)
                     ->andReturn(true);
        });

        // Act
        $createPaymentService = new CreatePaymentService($this->createPaymentRepository);
        $result = $createPaymentService->create($this->request);

        // Assert
        $this->assertTrue($result);
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
