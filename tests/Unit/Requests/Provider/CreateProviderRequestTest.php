<?php

namespace Tests\Unit\Requests;

use App\Http\Requests\Provider\CreateProviderRequest;
use App\Support\Generate\GenerateCNPJ;
use App\Support\Generate\GenerateEmail;
use Illuminate\Support\Str;
use LaravelLegends\PtBrValidator\Rules\Cnpj;
use Tests\TestCase;

class CreateProviderRequestTest extends TestCase
{
    private CreateProviderRequest $request;

    private function request(): CreateProviderRequest
    {
        $this->request = new CreateProviderRequest();
        $this->request['razaoSocial'] = Str::random(10);
        $this->request['cnpj'] = GenerateCNPJ::generateCNPJ();
        $this->request['email'] = GenerateEmail::generateEmail();
        $this->request['dataFundacao'] = date('Y-m-d H:i:s');
        $this->request['ativo'] = true;
        return $this->request;
    }

    public function test_request_validation_rules(): void
    {
        // Arrange
        $this->request();

        // Act
        $data = [
            'razaoSocial' => 'required|string|unique:fornecedor,razao_social',
            'cnpj' => [
                0 => 'required',
                1 => new Cnpj(),
            ],
            'email' => 'required|string|unique:fornecedor,email|regex:/(.+)@(.+)\.(.+)/i',
            'dataFundacao' => 'required|date',
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
        $resultReasonSocial = isset($this->request['razaoSocial']);
        $resultCnpj = isset($this->request['cnpj']);
        $resultEmail = isset($this->request['email']);
        $resultDate = $this->caseDate($this->request['dataFundacao']);
        $resultActive = isset($this->request['ativo']);

        // Assert
        $this->assertTrue($resultReasonSocial);
        $this->assertTrue($resultCnpj);
        $this->assertTrue($resultEmail);
        $this->assertTrue($resultDate);
        $this->assertTrue($resultActive);
    }

    public function test_request_type(): void
    {
        // Arrange
        $this->request();

        // Act
        $resultReasonSocial = is_string($this->request['razaoSocial']);
        $resultCnpj = is_string($this->request['cnpj']);
        $resultEmail = is_string($this->request['email']);
        $resultDate = $this->caseDate($this->request['dataFundacao']);
        $resultActive = is_bool($this->request['ativo']);

        // Assert
        $this->assertTrue($resultReasonSocial);
        $this->assertTrue($resultCnpj);
        $this->assertTrue($resultEmail);
        $this->assertTrue($resultDate);
        $this->assertTrue($resultActive);
    }

    public function test_request_absence_mask(): void
    {
        // Arrange
        $dominio = array('@gmail.com', '@outlook.com', '@business.com.br');
        $rand_keys = array_rand($dominio);
        $this->request = new CreateProviderRequest();
        $this->request['cnpj'] = str_replace(array('.','-','/'), "", GenerateCNPJ::generateCNPJ());
        $this->request['email'] = Str::random(10);

        // Act
        if ($this->request['cnpj'] != $this->mask($this->request['cnpj'], "##.###.###/####-##")):
            $resultCnpj = true;
        endif;

        if ($this->request['email'] != $this->request['email'] . $dominio[$rand_keys]):
            $resultEmail = true;
        endif;

        // Assert
        $this->assertTrue($resultCnpj);
        $this->assertTrue($resultEmail);
    }
}
