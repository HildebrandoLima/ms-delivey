<?php

namespace Tests\Unit\Services\Address;

use App\Data\Infra\Integration\IntegrationViaCep;
use App\Services\Address\Concretes\IntegrationViaCepService;
use Mockery\MockInterface;
use Tests\TestCase;

class IntegrationViaCepServiceTest extends TestCase
{
    private IntegrationViaCep $integrationViaCep;

    public function test_success_integration_via_cep_service(): void
    {
        // Arrange
        $cep = rand(10000, 20000) . '-' . rand(100, 200);
        $expectedResult = collect([]);

        $this->integrationViaCep = $this->mock(IntegrationViaCep::class,
            function (MockInterface $mock) use ($expectedResult, $cep) {
                $mock->shouldReceive('integrationViaCep')->with($cep)->andReturn($expectedResult);
        });

        // Act
        $integrationViaCepService = new IntegrationViaCepService($this->integrationViaCep);
        $result = $integrationViaCepService->integrationViaCep($cep);

        // Assert
        $this->assertSame($result, $expectedResult);
    }
}
