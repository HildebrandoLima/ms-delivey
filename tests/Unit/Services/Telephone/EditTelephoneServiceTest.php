<?php

namespace Tests\Unit\Services\Telephone;

use App\Http\Requests\Telephone\EditTelephoneRequest;
use App\Models\Telefone;
use App\Repositories\Interfaces\TelephoneRepositoryInterface;
use App\Services\Telephone\Concretes\EditTelephoneService;
use App\Support\Enums\PerfilEnum;
use Mockery\MockInterface;
use Tests\TestCase;

class EditTelephoneServiceTest extends TestCase
{
    private EditTelephoneRequest $request;
    private TelephoneRepositoryInterface $telephoneRepository;
    private array $type = array('Fixo', 'Celular');

    public function test_success_edit_telephone_with_params_user_id_service(): void
    {
        // Arrange
        $rand_keys = array_rand($this->type);
        $this->request = new EditTelephoneRequest();
        $this->request['id'] = rand(1, 100);
        $this->request['numero'] = '(' . rand(10, 20) . ')9' . rand(1000, 2000) . '-' . rand(1000, 2000);
        $this->request['tipo'] = $this->type[$rand_keys];
        $this->request['cep'] = rand(10000, 20000) . '-' . rand(100, 200);
        $this->request['usuarioId'] = rand(1, 100);
        $this->request['ativo'] = true;

        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->telephoneRepository = $this->mock(TelephoneRepositoryInterface::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('update')->with(Telefone::class)->andReturn(true);
        });

        // Act
        $editTelephoneService = new EditTelephoneService($this->telephoneRepository);

        $result = $editTelephoneService->editTelephone($this->request);

        // Assert
        $this->assertTrue($result);
    }

    public function test_success_edit_telephone_with_params_provider_id_service(): void
    {
        // Arrange
        $rand_keys = array_rand($this->type);
        $this->request = new EditTelephoneRequest();
        $this->request['id'] = rand(1, 100);
        $this->request['numero'] = '9' . rand(1000, 2000) . '-' . rand(1000, 2000);
        $this->request['tipo'] = $this->type[$rand_keys];
        $this->request['dddId'] = rand(1, 23);
        $this->request['cep'] = rand(10000, 20000) . '-' . rand(100, 200);
        $this->request['fornecedorId'] = rand(1, 100);
        $this->request['ativo'] = true;

        $authenticate = $this->authenticate(PerfilEnum::CLIENTE);

        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->telephoneRepository = $this->mock(TelephoneRepositoryInterface::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('update')->with(Telefone::class)->andReturn(true);
        });

        // Act
        $editTelephoneService = new EditTelephoneService($this->telephoneRepository);

        $result = $editTelephoneService->editTelephone($this->request);

        // Assert
        $this->assertTrue($result);
    }
}
