<?php

namespace Tests\Unit\Services\Telephone;

use App\Http\Requests\Telephone\EditTelephoneRequest;
use App\Models\Telefone;
use App\Repositories\Abstracts\IEntityRepository;
use App\Services\Telephone\Concretes\EditTelephoneService;
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
        $this->request = new EditTelephoneRequest();

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

        // Assert
        $this->assertTrue($result);
    }

    public function test_success_edit_telephone_with_params_provider_id_service(): void
    {
        // Arrange
        $this->request = new EditTelephoneRequest();

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

        // Assert
        $this->assertTrue($result);
    }
}
