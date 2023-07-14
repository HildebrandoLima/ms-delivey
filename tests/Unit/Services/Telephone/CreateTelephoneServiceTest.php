<?php

namespace Tests\Unit\Services\Telephone;

use App\Http\Requests\TelephoneRequest;
use App\Models\Fornecedor;
use App\Models\Telefone;
use App\Models\User;
use App\Repositories\Interfaces\CheckEntityRepositoryInterface;
use App\Repositories\Interfaces\TelephoneRepositoryInterface;
use App\Services\Telephone\Concretes\CreateTelephoneService;
use Mockery\MockInterface;
use Tests\TestCase;

class CreateTelephoneServiceTest extends TestCase
{
    private TelephoneRequest $request;
    private CheckEntityRepositoryInterface $checkEntityRepository;
    private TelephoneRepositoryInterface $telephoneRepository;
    private array $type = array('Fixo', 'Celular');

    public function test_success_create_address_with_params_user_id_service(): void
    {
        // Arrange
        $rand_keys = array_rand($this->type);
        $this->request = new TelephoneRequest();
        $this->request['telefones'] = [
            "numero" => '9' . rand(1000, 2000) . '-' . rand(1000, 2000),
            "tipo" => $this->type[$rand_keys],
            "dddId" => rand(1, 23),
            "cep" => rand(10000, 20000) . '-' . rand(100, 200),
            "usuarioId" => User::query()->first()->id,
            "ativo" => true,
        ];

        $this->checkEntityRepository = $this->mock(CheckEntityRepositoryInterface::class,
        function (MockInterface $mock) {
            $mock->shouldReceive('checkTelephoneExist')->with(str_replace('-', "", $this->request['telefones']['numero']));
        });

        $this->telephoneRepository = $this->mock(TelephoneRepositoryInterface::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('create')->with(Telefone::class)->andReturn(true);
        });

        // Act
        $createAddressService = new CreateTelephoneService
        (
            $this->checkEntityRepository,
            $this->telephoneRepository
        );

        $result = $createAddressService->createTelephone($this->request);

        // Assert
        $this->assertTrue($result);
    }

    public function test_success_create_address_with_params_provider_id_service(): void
    {
        // Arrange
        $rand_keys = array_rand($this->type);
        $this->request = new TelephoneRequest();
        $this->request['telefones'] = [
            "numero" => '9' . rand(1000, 2000) . '-' . rand(1000, 2000),
            "tipo" => $this->type[$rand_keys],
            "dddId" => rand(1, 23),
            "cep" => rand(10000, 20000) . '-' . rand(100, 200),
            "fornecedorId" => Fornecedor::query()->first()->id,
            "ativo" => true,
        ];

        $this->checkEntityRepository = $this->mock(CheckEntityRepositoryInterface::class,
        function (MockInterface $mock) {
            $mock->shouldReceive('checkTelephoneExist')->with(str_replace('-', "", $this->request['telefones']['numero']));
        });

        $this->telephoneRepository = $this->mock(TelephoneRepositoryInterface::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('create')->with(Telefone::class)->andReturn(true);
        });

        // Act
        $createAddressService = new CreateTelephoneService
        (
            $this->checkEntityRepository,
            $this->telephoneRepository
        );

        $result = $createAddressService->createTelephone($this->request);

        // Assert
        $this->assertTrue($result);
    }
}