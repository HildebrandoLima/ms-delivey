<?php

namespace Tests\Unit\Services\Provider;

use App\Data\Repositories\Provider\Interfaces\IUpdateProviderRepository;
use App\Domains\Services\Provider\Concretes\UpdateProviderService;
use App\Http\Requests\Provider\UpdateProviderRequest;
use Mockery\MockInterface;
use Tests\TestCase;

class UpdateProviderServiceTest extends TestCase
{
    private UpdateProviderRequest $request;
    private IUpdateProviderRepository $updateProviderRepository;
    private array $data = [];

    protected function setUp(): void
    {
        parent::setUp();
        $this->data = $this->setDataProvider();
    }

    public function test_success_edit_user_service(): void
    {
        // Arrange
        $this->request = new UpdateProviderRequest();
        $this->request['id'] = $this->data['id'];
        $this->request['razaoSocial'] = $this->data['razaoSocial'];
        $this->request['cnpj'] = $this->data['cnpj'];
        $this->request['email'] = $this->data['email'];
        $this->request['dataFundacao'] = $this->data['dataFundacao'];
        $this->request['ativo'] = $this->data['ativo'];

        $this->updateProviderRepository = $this->mock(IUpdateProviderRepository::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('update')
                     ->with($this->request)
                     ->andReturn(true);
        });

        // Act
        $updateProviderService = new UpdateProviderService($this->updateProviderRepository);
        $result = $updateProviderService->update($this->request);

        // Assert
        $this->assertTrue($result);
        $this->assertEquals($this->request['id'], $this->data['id']);
        $this->assertEquals($this->request['razaoSocial'], $this->data['razaoSocial']);
        $this->assertEquals($this->request['cnpj'], $this->data['cnpj']);
        $this->assertEquals($this->request['email'], $this->data['email']);
        $this->assertEquals($this->request['dataFundacao'], $this->data['dataFundacao']);
        $this->assertEquals($this->request['ativo'], $this->data['ativo']);
    }
}
