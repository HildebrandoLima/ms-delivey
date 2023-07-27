<?php

namespace Tests\Unit\Requests;

use App\Http\Requests\Provider\EditProviderRequest;
use App\Support\Generate\GenerateCNPJ;
use App\Support\Generate\GenerateEmail;
use Illuminate\Support\Str;
use LaravelLegends\PtBrValidator\Rules\Cnpj;
use Tests\TestCase;

class EditProviderRequestTest extends TestCase
{
    private EditProviderRequest $request;

    private function request(): EditProviderRequest
    {
        $this->request = new EditProviderRequest();
        $this->request['id'] = rand(1, 100);
        $this->request['razaoSocial'] = Str::random(10);
        $this->request['cnpj'] = GenerateCNPJ::generateCNPJ();
        $this->request['email'] = GenerateEmail::generateEmail();
        $this->request['ativo'] = true;
        return $this->request;
    }

    public function test_request_validation_rules(): void
    {
        // Arrange
        $this->request();

        // Act
        $data = [
            'id' => 'required|int|exists:fornecedor,id',
            'razaoSocial' => 'required|string',
            'cnpj' => [
                0 => 'required',
                1 => new Cnpj(),
            ],
            'email' => 'required|string|regex:/(.+)@(.+)\.(.+)/i',
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
        $resultActive = isset($this->request['ativo']);

        // Assert
        $this->assertTrue($resultReasonSocial);
        $this->assertTrue($resultCnpj);
        $this->assertTrue($resultEmail);
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
        $resultActive = is_bool($this->request['ativo']);

        // Assert
        $this->assertTrue($resultReasonSocial);
        $this->assertTrue($resultCnpj);
        $this->assertTrue($resultEmail);
        $this->assertTrue($resultActive);
    }

    public function test_request_absence_mask(): void
    {
        // Arrange
        $dominio = array('@gmail.com', '@outlook.com', '@business.com.br');
        $rand_keys = array_rand($dominio);
        $this->request = new EditProviderRequest();
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
