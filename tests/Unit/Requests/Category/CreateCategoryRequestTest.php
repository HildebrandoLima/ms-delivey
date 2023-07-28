<?php

namespace Tests\Unit\Requests\Category;

use App\Http\Requests\Category\CreateCategoryRequest;
use Tests\TestCase;

class CategoryRequestTest extends TestCase
{
    public function test_request_validation_rules(): void
    {
        // Arrange
        $request = new CreateCategoryRequest();

        // Act
        $data = [
            'nome' => 'required|string|unique:categoria,nome',
            'ativo' => 'required|boolean',
        ];

        // Assert
        $this->assertEquals($data, $request->rules());
    }
}
