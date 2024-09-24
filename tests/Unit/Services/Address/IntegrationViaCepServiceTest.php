<?php

namespace Tests\Unit\Services\Address;

use App\Data\Infra\Integration\IntegrationViaCep;
use App\Domains\Services\Address\Concretes\IntegrationViaCepService;
use Mockery\MockInterface;
use Tests\TestCase;

class IntegrationViaCepServiceTest extends TestCase
{
    private IntegrationViaCep $integrationViaCep;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_success_integration_via_cep_service(): void
    {
        // Arrange
        $cep = '01001000';
        $expectedResult = collect([]);

        $this->integrationViaCep = $this->mock(IntegrationViaCep::class,
            function (MockInterface $mock) use ($expectedResult, $cep) {
                $mock->shouldReceive('integrationViaCep')->with($cep)->andReturn($expectedResult);
        });

        // Act
        $integrationViaCepService = new IntegrationViaCepService($this->integrationViaCep);
        $result = $integrationViaCepService->integration($cep);

        // Assert
        $this->assertSame($result, $expectedResult);
    }
}
