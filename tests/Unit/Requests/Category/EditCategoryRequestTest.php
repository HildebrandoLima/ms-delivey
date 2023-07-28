<?php

namespace Tests\Unit\Requests\Category;

use App\Http\Requests\Category\EditCategoryRequest;
use Tests\TestCase;

class EditCategoryRequestTest extends TestCase
{
    public function test_request_validation_rules(): void
    {
        // Arrange
        $request = new EditCategoryRequest();

        // Act
        $data = [
            'id' => 'required|int|exists:categoria,id',
            'nome' => 'required|string',
            'ativo' => 'required|boolean'
        ];

        // Assert
        $this->assertEquals($data, $request->rules());
    }  
}
