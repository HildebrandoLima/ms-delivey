<?php

namespace Tests\Unit\Requests\Category;

use App\Http\Requests\Category\CategoryRequest;
use Illuminate\Support\Str;
use Tests\TestCase;

class CategoryRequestTest extends TestCase
{
    private CategoryRequest $request;

    private function request(): CategoryRequest
    {
        $this->request = new CategoryRequest();
        $this->request['nome'] = Str::random(10);
        $this->request['ativo'] = true;
        return $this->request;
    }

    public function test_request_validation_rules(): void
    {
        // Arrange
        $this->request();

        // Act
        $data = [
            'nome' => 'required|string|unique:categoria,nome',
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
        $resultName = isset($this->request['nome']);
        $resultActive = isset($this->request['ativo']);

        // Assert
        $this->assertTrue($resultName);
        $this->assertTrue($resultActive);
    }

    public function test_request_type(): void
    {
        // Arrange
        $this->request();

        // Act
        $resultName = is_string($this->request['nome']);
        $resultActive = is_bool($this->request['ativo']);

        // Assert
        $this->assertTrue($resultName);
        $this->assertTrue($resultActive);
    }
}
