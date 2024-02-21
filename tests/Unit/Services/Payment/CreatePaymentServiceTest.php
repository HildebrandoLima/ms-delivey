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

    public function clearMockery(): void
    {
        $this->tearDown();
    }

    public function test_success_create_payment_service(): void
    {
        // Arrange
        $createdPayment = Pagamento::query()->first();
        $this->request = new CreatePaymentRequest();
        $this->request['numeroCartao'] = $createdPayment->numero_cartao;
        $this->request['tipoCartao'] = $createdPayment->tipo_cartao;
        $this->request['ccv'] = $createdPayment->ccv;
        $this->request['dataValidade'] = $createdPayment->data_validade;
        $this->request['parcela'] = $createdPayment->parcela;
        $this->request['total'] = $createdPayment->total;
        $this->request['metodoPagamento'] = $createdPayment->metodo_pagamento;
        $this->request['pedidoId'] = $createdPayment->pedido_id;
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
        $mappedPayment = $createPaymentService->map($this->request);

        // Assert
        $this->assertTrue($result);
        $this->assertInstanceOf(Pagamento::class, $mappedPayment);
        $this->assertEquals($this->request['numeroCartao'], $createdPayment->numero_cartao);
        $this->assertEquals($this->request['tipoCartao'], $createdPayment->tipo_cartao);
        $this->assertEquals($this->request['ccv'], $createdPayment->ccv);
        $this->assertEquals($this->request['dataValidade'], $createdPayment->data_validade);
        $this->assertEquals($this->request['parcela'], $createdPayment->parcela);
        $this->assertEquals($this->request['total'], $createdPayment->total);
        $this->assertEquals($this->request['metodoPagamento'], $createdPayment->metodo_pagamento);
        $this->assertEquals($this->request['pedidoId'], $createdPayment->pedido_id);
    }
}
