<?php

namespace Tests\Unit\Requests;

use App\Http\Requests\ProviderRequest;
use App\Support\Generate\GenerateCNPJ;
use App\Support\Generate\GenerateEmail;
use Illuminate\Support\Str;
use Tests\TestCase;

class ProviderRequestTest extends TestCase
{
    private ProviderRequest $request;

    private function request(): ProviderRequest
    {
        $this->request = new ProviderRequest();
        $this->request['razaoSocial'] = Str::random(10);
        $this->request['cnpj'] = GenerateCNPJ::generateCNPJ();
        $this->request['email'] = GenerateEmail::generateEmail();
        $this->request['dataFundacao'] = date('Y-m-d H:i:s');
        $this->request['ativo'] = true;
        return $this->request;
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
        $this->request = new ProviderRequest();
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
