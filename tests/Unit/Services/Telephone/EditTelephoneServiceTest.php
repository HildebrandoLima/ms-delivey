<?php

namespace Tests\Unit\Services\Telephone;

use App\Data\Repositories\Abstracts\IEntityRepository;
use App\Domains\Models\Telefone;
use App\Domains\Services\Telephone\Concretes\EditTelephoneService;
use App\Http\Requests\Telephone\EditTelephoneRequest;
use App\Support\Enums\PerfilEnum;
use Mockery\MockInterface;
use Tests\TestCase;

class EditTelephoneServiceTest extends TestCase
{
    private EditTelephoneRequest $request;
    private IEntityRepository $telephoneRepository;

    public function test_success_edit_telephone_with_params_user_id_service(): void
    {
        // Arrange
        $editedTelephone = Telefone::query()->first();
        $this->request = new EditTelephoneRequest();
        $this->request['id'] = $editedTelephone->id;
        $this->request['ddd'] = $editedTelephone->ddd;
        $this->request['numero'] = $editedTelephone->numero;
        $this->request['tipo'] = $editedTelephone->tipo;
        $this->request['usuarioId'] = $editedTelephone->usuario_id;
        $this->request['ativo'] = $editedTelephone->ativo;
        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->telephoneRepository = $this->mock(IEntityRepository::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('update')->with(Telefone::class)->andReturn(true);
        });

        // Act
        $editTelephoneService = new EditTelephoneService($this->telephoneRepository);
        $result = $editTelephoneService->editTelephone($this->request);
        $mappedTelephone = $editTelephoneService->map($this->request);

        // Assert
        $this->assertTrue($result);
        $this->assertInstanceOf(Telefone::class, $mappedTelephone);
        $this->assertEquals($this->request['id'], $editedTelephone->id);
        $this->assertEquals($this->request['ddd'], $editedTelephone->ddd);
        $this->assertEquals($this->request['numero'], $editedTelephone->numero);
        $this->assertEquals($this->request['tipo'], $editedTelephone->tipo);
        $this->assertEquals($this->request['usuarioId'], $editedTelephone->usuario_id);
        $this->assertEquals($this->request['ativo'], $editedTelephone->ativo);
    }

    public function test_success_edit_telephone_with_params_provider_id_service(): void
    {
        // Arrange
        $editedTelephone = Telefone::query()->first();
        $this->request = new EditTelephoneRequest();
        $this->request['id'] = $editedTelephone->id;
        $this->request['ddd'] = $editedTelephone->ddd;
        $this->request['numero'] = $editedTelephone->numero;
        $this->request['tipo'] = $editedTelephone->tipo;
        $this->request['fornecedorId'] = $editedTelephone->fornecedor_id;
        $this->request['ativo'] = $editedTelephone->ativo;
        $authenticate = $this->authenticate(PerfilEnum::ADMIN);

        $this->withHeaders([
            'Authorization' => 'Bearer '. $authenticate['accessToken'],
        ]);

        $this->telephoneRepository = $this->mock(IEntityRepository::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('update')->with(Telefone::class)->andReturn(true);
        });

        // Act
        $editTelephoneService = new EditTelephoneService($this->telephoneRepository);
        $result = $editTelephoneService->editTelephone($this->request);
        $mappedTelephone = $editTelephoneService->map($this->request);

        // Assert
        $this->assertTrue($result);
        $this->assertInstanceOf(Telefone::class, $mappedTelephone);
        $this->assertEquals($this->request['id'], $editedTelephone->id);
        $this->assertEquals($this->request['ddd'], $editedTelephone->ddd);
        $this->assertEquals($this->request['numero'], $editedTelephone->numero);
        $this->assertEquals($this->request['tipo'], $editedTelephone->tipo);
        $this->assertEquals($this->request['fornecedorId'], $editedTelephone->fornecedor_id);
        $this->assertEquals($this->request['ativo'], $editedTelephone->ativo);
    }
}
