<?php

namespace Tests\Unit\Requests;

use App\Http\Requests\AddressRequest;
use App\Models\Fornecedor;
use App\Models\UnidadeFederativa;
use App\Models\User;
use Illuminate\Support\Str;
use Tests\TestCase;

class AddressRequestTest extends TestCase
{
    private AddressRequest $request;
    private array $public_place = array('Rua', 'Avenida');

    public function test_request_required(): void
    {
        // Arrange
        $rand_keys = array_rand($this->public_place);
        $this->request = new AddressRequest();
        $this->request['logradouro'] = $this->public_place[$rand_keys];
        $this->request['descricao'] = Str::random(10);
        $this->request['bairro'] = Str::random(10);
        $this->request['cidade'] = Str::random(10);
        $this->request['cep'] = rand(10000, 20000) . '-' . rand(100, 200);
        $this->request['ufId'] = rand(1, 27);
        $this->request['ativo'] = true;

        // Act
        $resultPublicPlace = isset($this->request['logradouro']);
        $resultDescription = isset($this->request['descricao']);
        $resultNeighborhood = isset($this->request['bairro']);
        $resultCity = isset($this->request['cidade']);
        $resultCep = isset($this->request['cep']);
        $resultUf = isset($this->request['ufId']);
        $resultActive = isset($this->request['ativo']);

        // Assert
        $this->assertTrue($resultPublicPlace);
        $this->assertTrue($resultDescription);
        $this->assertTrue($resultNeighborhood);
        $this->assertTrue($resultCity);
        $this->assertTrue($resultCep);
        $this->assertTrue($resultUf);
        $this->assertTrue($resultActive);
    }

    public function test_request_type(): void
    {
        // Arrange
        $rand_keys = array_rand($this->public_place);
        $this->request = new AddressRequest();
        $this->request['logradouro'] = $this->public_place[$rand_keys];
        $this->request['descricao'] = Str::random(10);
        $this->request['bairro'] = Str::random(10);
        $this->request['cidade'] = Str::random(10);
        $this->request['cep'] = rand(10000, 20000) . '-' . rand(100, 200);
        $this->request['ufId'] = rand(1, 27);
        $this->request['usuarioId'] = rand(1, 100);
        $this->request['fornecedorId'] = rand(1, 100);
        $this->request['ativo'] = true;

        // Act
        $resultPublicPlace = is_string($this->request['logradouro']);
        $resultDescription = is_string($this->request['descricao']);
        $resultNeighborhood = is_string($this->request['bairro']);
        $resultCity = is_string($this->request['cidade']);
        $resultCep = is_string($this->request['cep']);
        $resultUf = is_int($this->request['ufId']);
        $resultUserId = is_int($this->request['usuarioId']);
        $resultProviderId = is_int($this->request['fornecedorId']);
        $resultActive = is_bool($this->request['ativo']);

        // Assert
        $this->assertTrue($resultPublicPlace);
        $this->assertTrue($resultDescription);
        $this->assertTrue($resultNeighborhood);
        $this->assertTrue($resultCity);
        $this->assertTrue($resultCep);
        $this->assertTrue($resultUf);
        $this->assertTrue($resultUserId);
        $this->assertTrue($resultProviderId);
        $this->assertTrue($resultActive);
    }

    public function test_request_absence_mask(): void
    {
        // Arrange
        $this->request = new AddressRequest();
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
        User::factory()->createOne();
        Fornecedor::factory()->createOne();
        $this->request = new AddressRequest();
        $this->request['ufId'] = UnidadeFederativa::query()->first()->id;
        $this->request['usuarioId'] = User::query()->first()->id;
        $this->request['fornecedorId'] = Fornecedor::query()->first()->id;

        // Act
        $resultUf = isset($this->request['ufId']);
        $resultUserId = isset($this->request['usuarioId']);
        $resultProviderId = isset($this->request['fornecedorId']);

        // Assert
        $this->assertTrue($resultUf);
        $this->assertTrue($resultUserId);
        $this->assertTrue($resultProviderId);
    }
}
