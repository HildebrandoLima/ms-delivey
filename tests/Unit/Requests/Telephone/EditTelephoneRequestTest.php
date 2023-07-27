<?php

namespace Tests\Unit\Requests\Telephone;

use App\Http\Requests\Telephone\EditTelephoneRequest;
use App\Models\Fornecedor;
use App\Models\Telefone;
use App\Models\User;
use Tests\TestCase;

class EditTelephoneRequestTest extends TestCase
{
    private EditTelephoneRequest $request;
    private array $type = array('Fixo', 'Celular');

    private function request(): EditTelephoneRequest
    {
        $rand_keys = array_rand($this->type);
        $telephone = Telefone::query()->first()->toArray();
        $this->request = new EditTelephoneRequest();
        $this->request['id'] = $telephone['id'];
        $this->request['numero'] = '9' . rand(1000, 2000) . '-' . rand(1000, 2000);
        $this->request['tipo'] = $this->type[$rand_keys];
        $this->request['dddId'] = $telephone['ddd_id'];
        $this->request['usuarioId'] = $telephone['usuario_id'] ?? null;
        $this->request['fornecedorId'] = $telephone['fornecedor_id'] ?? null;
        $this->request['ativo'] = (bool)$telephone['ativo'];
        return $this->request;
    }

    public function test_request_validation_rules(): void
    {
        // Arrange
        $this->request();

        // Act
        $data = [
            'id' => 'required|int|exists:telefone,id',
            'numero' => 'required|string|Celular|min:10|max:10',
            'tipo' => 'required|string',
            'dddId' => 'required|int|exists:ddd,id',
            'usuarioId' => 'int|exists:users,id',
            'fornecedorId' => 'int|exists:fornecedor,id',
            'ativo' => 'required|boolean',
        ];

        // Assert
        $this->assertEquals($data, $this->request()->rules());
    }

    public function test_request_required(): void
    {
        // Arrange
        $this->request();

        // Act
        $resultTelephoneNumber = isset($this->request['numero']);
        $resultTelephoneType = isset($this->request['tipo']);
        $resultTelephoneDDDId = isset($this->request['dddId']);
        $resultTelephoneActive = isset($this->request['ativo']);

        // Assert
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
        $resultTelephoneNumber = is_string($this->request['numero']);
        $resultTelephoneType = is_string($this->request['tipo']);
        $resultTelephoneDDDId = is_int($this->request['dddId']);
        $resultTelephoneActive = is_bool($this->request['ativo']);

        // Assert
        $this->assertTrue($resultTelephoneNumber);
        $this->assertTrue($resultTelephoneType);
        $this->assertTrue($resultTelephoneDDDId);
        $this->assertTrue($resultTelephoneActive);
    }

    public function test_request_absence_mask(): void
    {
        // Arrange
        $this->request();
        $this->request['numero'] = str_replace('-', "", '9' . rand(1000, 2000) . '-' . rand(1000, 2000));

        // Act
        if ($this->request['numero'] != $this->mask($this->request['numero'], "#####-####")):
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
        $resultTelephoneDDDId = isset($this->request['dddId']);
        $resultTelephoneUserId = isset($this->request['usuarioId']);
        $resultTelephoneProviderId = isset($this->request['fornecedorId']);

        // Assert
        $this->assertTrue($resultTelephoneDDDId);
        $this->assertTrue($resultTelephoneUserId);
        $this->assertTrue($resultTelephoneProviderId);
    }
}
