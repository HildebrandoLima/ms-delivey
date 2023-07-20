<?php

namespace Tests\Unit\Requests;

use App\Http\Requests\TelephoneRequest;
use App\Models\DDD;
use App\Models\Fornecedor;
use App\Models\User;
use Tests\TestCase;

class TelephoneRequestTest extends TestCase
{
    private TelephoneRequest $request;
    private array $type = array('Fixo', 'Celular');

    private function request(): TelephoneRequest
    {
        $rand_keys = array_rand($this->type);
        $this->request = new TelephoneRequest();
        $this->request['telephones'] = [
            "numero" => str_replace('-', "", '9' . rand(1000, 2000) . '-' . rand(1000, 2000)),
            "tipo" => $this->type[$rand_keys],
            "dddId" => DDD::query()->first()->id,
            "usuarioId" => User::query()->first()->id,
            "fornecedorId" => Fornecedor::query()->first()->id,
            "ativo" => true,
        ];
        return $this->request;
    }

    public function test_request_required(): void
    {
        // Arrange
        $this->request();

        // Act
        $resultTelephone = isset($this->request['telephones']);
        $resultTelephoneNumber = isset($this->request['telephones']['numero']);
        $resultTelephoneType = isset($this->request['telephones']['tipo']);
        $resultTelephoneDDDId = isset($this->request['telephones']['dddId']);
        $resultTelephoneActive = isset($this->request['telephones']['ativo']);

        // Assert
        $this->assertTrue($resultTelephone);
        $this->assertTrue($resultTelephoneNumber);
        $this->assertTrue($resultTelephoneType);
        $this->assertTrue($resultTelephoneDDDId);
        $this->assertTrue($resultTelephoneActive);
    }

    public function test_request_type(): void
    {
        // Arrange
        $this->request();

        // Act
        $resultTelephone = is_array($this->request['telephones']);
        $resultTelephoneNumber = is_string($this->request['telephones']['numero']);
        $resultTelephoneType = is_string($this->request['telephones']['tipo']);
        $resultTelephoneDDDId = is_int($this->request['telephones']['dddId']);
        $resultTelephoneUserId = is_int($this->request['telephones']['usuarioId']);
        $resultTelephoneProviderId = is_int($this->request['telephones']['fornecedorId']);
        $resultTelephoneActive = is_bool($this->request['telephones']['ativo']);

        // Assert
        $this->assertTrue($resultTelephone);
        $this->assertTrue($resultTelephoneNumber);
        $this->assertTrue($resultTelephoneType);
        $this->assertTrue($resultTelephoneDDDId);
        $this->assertTrue($resultTelephoneUserId);
        $this->assertTrue($resultTelephoneProviderId);
        $this->assertTrue($resultTelephoneActive);
    }

    public function test_request_absence_mask(): void
    {
        // Arrange
        $rand_keys = array_rand($this->type);
        $this->request = new TelephoneRequest();
        $this->request['telephones'] = [
            "numero" => str_replace('-', "", '9' . rand(1000, 2000) . '-' . rand(1000, 2000)),
            "tipo" => $this->type[$rand_keys],
            "dddId" => rand(1, 23),
            "ativo" => true,
        ];

        // Act
        if ($this->request['telephones']['numero'] != $this->mask($this->request['telephones']['numero'], "#####-####")):
            $resultTelephoneNumber = true;
        endif;

        // Assert
        $this->assertTrue($resultTelephoneNumber);
    }

    public function test_request_exists(): void
    {
        // Arrange
        User::factory()->createOne();
        Fornecedor::factory()->createOne();
        $this->request();

        // Act
        $resultTelephoneDDDId = isset($this->request['telephones']['dddId']);
        $resultTelephoneUserId = isset($this->request['telephones']['usuarioId']);
        $resultTelephoneProviderId = isset($this->request['telephones']['fornecedorId']);

        // Assert
        $this->assertTrue($resultTelephoneDDDId);
        $this->assertTrue($resultTelephoneUserId);
        $this->assertTrue($resultTelephoneProviderId);
    }
}
