<?php

namespace Tests\Unit\Requests;

use App\Http\Requests\ParametersRequest;
use Illuminate\Support\Str;
use Tests\TestCase;

class ParametersRequestTest extends TestCase
{
    private ParametersRequest $request;

    private function request(): ParametersRequest
    {
        $this->request = new ParametersRequest();
        $this->request['id'] = rand(1, 100);
        $this->request['search'] = Str::random(10);
        $this->request['active'] = true;
        return $this->request;
    }

    public function test_request_required(): void
    {
        // Arrange
        $this->request();

        // Act
        $resultActive = isset($this->request['active']);

        // Assert
        $this->assertTrue($resultActive);
    }

    public function test_request_type(): void
    {
        // Arrange
        $this->request();

        // Act
        $resultId = is_int($this->request['id']);
        $resultSearch = is_string($this->request['search']);
        $resultActive = is_bool($this->request['active']);

        // Assert
        $this->assertTrue($resultId);
        $this->assertTrue($resultSearch);
        $this->assertTrue($resultActive);
    }
}
