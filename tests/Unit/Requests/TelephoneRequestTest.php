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

    public function test_request_required(): void
    {
        // Arrange
        $rand_keys = array_rand($this->type);
        $this->request = new TelephoneRequest();
        $this->request['telephones'] = [
            "numero" => '9' . rand(1000, 2000) . '-' . rand(1000, 2000),
            "tipo" => $this->type[$rand_keys],
            "dddId" => rand(1, 23),
            "ativo" => true,
        ];

        // Act
        $resultArrayTelephones = isset($this->request['telephones']);
        $resultArrayTelephonesNumber = isset($this->request['telephones']['numero']);
        $resultArrayTelephonesType = isset($this->request['telephones']['tipo']);
        $resultArrayTelephonesDDDId = isset($this->request['telephones']['dddId']);
        $resultArrayTelephonesActive = isset($this->request['telephones']['ativo']);

        // Assert
        $this->assertTrue($resultArrayTelephones);
        $this->assertTrue($resultArrayTelephonesNumber);
        $this->assertTrue($resultArrayTelephonesType);
        $this->assertTrue($resultArrayTelephonesDDDId);
        $this->assertTrue($resultArrayTelephonesActive);
    }

    public function test_request_type(): void
    {
        // Arrange
        $rand_keys = array_rand($this->type);
        $this->request = new TelephoneRequest();
        $this->request['telephones'] = [
            "numero" => '9' . rand(1000, 2000) . '-' . rand(1000, 2000),
            "tipo" => $this->type[$rand_keys],
            "dddId" => rand(1, 23),
            "usuarioId" => rand(1, 100),
            "fornecedorId" => rand(1, 100),
            "ativo" => true,
        ];

        // Act
        $resultArrayTelephones = is_array($this->request['telephones']);
        $resultArrayTelephonesNumber = is_string($this->request['telephones']['numero']);
        $resultArrayTelephonesType = is_string($this->request['telephones']['tipo']);
        $resultArrayTelephonesDDDId = is_int($this->request['telephones']['dddId']);
        $resultArrayTelephonesUserId = is_int($this->request['telephones']['usuarioId']);
        $resultArrayTelephonesProviderId = is_int($this->request['telephones']['fornecedorId']);
        $resultArrayTelephonesActive = is_bool($this->request['telephones']['ativo']);

        // Assert
        $this->assertTrue($resultArrayTelephones);
        $this->assertTrue($resultArrayTelephonesNumber);
        $this->assertTrue($resultArrayTelephonesType);
        $this->assertTrue($resultArrayTelephonesDDDId);
        $this->assertTrue($resultArrayTelephonesUserId);
        $this->assertTrue($resultArrayTelephonesProviderId);
        $this->assertTrue($resultArrayTelephonesActive);
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
            $resultArrayTelephonesNumber = true;
        endif;

        // Assert
        $this->assertTrue($resultArrayTelephonesNumber);
    }

    public function test_request_exists(): void
    {
        // Arrange
        User::factory()->createOne();
        Fornecedor::factory()->createOne();
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

        // Act
        $resultArrayTelephonesDDDId = isset($this->request['telephones']['dddId']);
        $resultArrayTelephonesUserId = isset($this->request['telephones']['usuarioId']);
        $resultArrayTelephonesProviderId = isset($this->request['telephones']['fornecedorId']);

        // Assert
        $this->assertTrue($resultArrayTelephonesDDDId);
        $this->assertTrue($resultArrayTelephonesUserId);
        $this->assertTrue($resultArrayTelephonesProviderId);
    }
}
