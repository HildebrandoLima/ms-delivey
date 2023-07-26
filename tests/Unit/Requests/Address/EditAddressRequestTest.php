<?php

namespace Tests\Unit\Requests\Address;

use App\Http\Requests\Address\EditAddressRequest;
use App\Models\Endereco;
use App\Models\Fornecedor;
use App\Models\UnidadeFederativa;
use App\Models\User;
use Illuminate\Support\Str;
use LaravelLegends\PtBrValidator\Rules\FormatoCep;
use Tests\TestCase;

class EditAddressRequestTest extends TestCase
{
    private EditAddressRequest $request;
    private array $public_place = array('Rua', 'Avenida');

    private function request(): EditAddressRequest
    {
        $rand_keys = array_rand($this->public_place);
        $this->request = new EditAddressRequest();
        $this->request['id'] = Endereco::query()->first()->id;
        $this->request['logradouro'] = $this->public_place[$rand_keys];
        $this->request['descricao'] = Str::random(10);
        $this->request['bairro'] = Str::random(10);
        $this->request['cidade'] = Str::random(10);
        $this->request['cep'] = rand(10000, 20000) . '-' . rand(100, 200);
        $this->request['ufId'] = UnidadeFederativa::query()->first()->id;
        $this->request['usuarioId'] = User::query()->first()->id;
        $this->request['fornecedorId'] = Fornecedor::query()->first()->id;
        $this->request['ativo'] = true;
        return $this->request;
    }

    public function test_request_validation_rules(): void
    {
        // Arrange
        $this->request();

        // Act
        $data = [
            'id' => 'required|int|exists:endereco,id',
            'logradouro' => 'required|string',
            'descricao' => 'required|string',
            'bairro' => 'required|string',
            'cidade' => 'required|string',
            'cep' => [
                0 => 'required',
                1 => new FormatoCep(),
            ],
            'ufId' => 'required|int|exists:unidade_federativa,id',
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
        $resultId = isset($this->request['id']);
        $resultPublicPlace = isset($this->request['logradouro']);
        $resultDescription = isset($this->request['descricao']);
        $resultNeighborhood = isset($this->request['bairro']);
        $resultCity = isset($this->request['cidade']);
        $resultCep = isset($this->request['cep']);
        $resultUfId = isset($this->request['ufId']);
        $resultActive = isset($this->request['ativo']);

        // Assert
        $this->assertTrue($resultId);
        $this->assertTrue($resultPublicPlace);
        $this->assertTrue($resultDescription);
        $this->assertTrue($resultNeighborhood);
        $this->assertTrue($resultCity);
        $this->assertTrue($resultCep);
        $this->assertTrue($resultUfId);
        $this->assertTrue($resultActive);
    }

    public function test_request_type(): void
    {
        // Arrange
        $this->request();

        // Act
        $resultId = is_int($this->request['id']);
        $resultPublicPlace = is_string($this->request['logradouro']);
        $resultDescription = is_string($this->request['descricao']);
        $resultNeighborhood = is_string($this->request['bairro']);
        $resultCity = is_string($this->request['cidade']);
        $resultCep = is_string($this->request['cep']);
        $resultUfId = is_int($this->request['ufId']);
        $resultUserId = is_int($this->request['usuarioId']);
        $resultProviderId = is_int($this->request['fornecedorId']);
        $resultActive = is_bool($this->request['ativo']);

        // Assert
        $this->assertTrue($resultId);
        $this->assertTrue($resultPublicPlace);
        $this->assertTrue($resultDescription);
        $this->assertTrue($resultNeighborhood);
        $this->assertTrue($resultCity);
        $this->assertTrue($resultCep);
        $this->assertTrue($resultUfId);
        $this->assertTrue($resultUserId);
        $this->assertTrue($resultProviderId);
        $this->assertTrue($resultActive);
    }

    public function test_request_absence_mask(): void
    {
        // Arrange
        $this->request();
        $this->request['cep'] = str_replace('-', "", rand(10000, 20000) . '-' . rand(100, 200));

        // Act
        if ($this->request['cep'] != $this->mask($this->request['cep'], "#####-###")):
            $resultCep = true;
        endif;

        // Assert
        $this->assertTrue($resultCep);
    }

    public function test_request_exists(): void
    {
        // Arrange
        $this->request();

        // Act
        $resultAddressId = Endereco::query()->where('id', '=', $this->request['id'])->first()->id;
        $resultUfId = UnidadeFederativa::query()->where('id', '=', $this->request['ufId'])->first()->id;
        $resultUserId = User::query()->where('id', '=', $this->request['usuarioId'])->first()->id;
        $resultProviderId = Fornecedor::query()->where('id', '=', $this->request['fornecedorId'])->first()->id;

        // Assert
        $this->assertEquals($this->request['id'], $resultAddressId);
        $this->assertEquals($this->request['ufId'], $resultUfId);
        $this->assertEquals($this->request['usuarioId'], $resultUserId);
        $this->assertEquals($this->request['fornecedorId'], $resultProviderId);
    }
}
