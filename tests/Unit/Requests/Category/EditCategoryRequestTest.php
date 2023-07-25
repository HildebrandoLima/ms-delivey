<?php

namespace Tests\Unit\Requests\Category;

use App\Http\Requests\Category\EditCategoryRequest;
use App\Models\Categoria;
use Tests\TestCase;

class EditCategoryRequestTest extends TestCase
{
    private EditCategoryRequest $request;

    private function request(): EditCategoryRequest
    {
        $category = Categoria::factory()->createOne()->toArray();
        $this->request = new EditCategoryRequest();
        $this->request['id'] = $category['id'];
        $this->request['nome'] = $category['nome'];
        $this->request['ativo'] = $category['ativo'];
        return $this->request;
    }

    public function test_request_validation_rules(): void
    {
        // Arrange
        $this->request();

        // Act
        $data = [
            'id' => 'required|int|exists:categoria,id',
            'nome' => 'required|string',
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
        $resultId = isset($this->request['id']);
        $resultName = isset($this->request['nome']);
        $resultActive = isset($this->request['ativo']);

        // Assert
        $this->assertTrue($resultName);
        $this->assertTrue($resultActive);
        $this->assertTrue($resultId);
    }

    public function test_request_type(): void
    {
        // Arrange
        $this->request();

        // Act
        $resultId = is_int($this->request['id']);
        $resultName = is_string($this->request['nome']);
        $resultActive = is_bool($this->request['ativo']);

        // Assert
        $this->assertTrue($resultName);
        $this->assertTrue($resultActive);
        $this->assertTrue($resultId);
    }
}
