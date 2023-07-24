<?php

namespace Tests\Unit\Requests\Address;

use App\Http\Requests\Address\ParamsAddressRequest;
use App\Models\Endereco;
use Tests\TestCase;

class ParamsAddressRequestTest extends TestCase
{
    private ParamsAddressRequest $request;

    private function request(): ParamsAddressRequest
    {
        Endereco::factory()->createOne();
        $this->request = new ParamsAddressRequest();
        $this->request['id'] = Endereco::query()->first()->id;
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
            'ativo' => 'required|boolean'
        ];

        // Assert
        $this->assertEquals($data, $this->request()->rules());
    }

    public function test_request_required(): void
    {
        // Arrange
        $this->request();

        // Act
        $resultAddressId = isset($this->request['id']);
        $resultActive = isset($this->request['ativo']);

        // Assert
        $this->assertTrue($resultAddressId);
        $this->assertTrue($resultActive);
    }

    public function test_request_type(): void
    {
        // Arrange
        $this->request();

        // Act
        $resultAddressId = is_int($this->request['id']);
        $resultActive = is_bool($this->request['ativo']);

        // Assert
        $this->assertTrue($resultAddressId);
        $this->assertTrue($resultActive);
    }

    public function test_request_exists(): void
    {
        // Arrange
        $this->request();

        // Act
        $resultAddressId = Endereco::query()->where('id', '=', $this->request['id'])->first()->id;

        // Assert
        $this->assertEquals($this->request['id'], $resultAddressId);
    }
}
