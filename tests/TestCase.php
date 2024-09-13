<?php

namespace Tests;

use App\Domains\Traits\GenerateData\GenerateCNPJ;
use App\Domains\Traits\GenerateData\GenerateCPF;
use App\Domains\Traits\GenerateData\GenerateEmail;
use App\Domains\Traits\GenerateData\GeneratePassword;
use App\Models\User;
use App\Support\Enums\RoleEnum;
use App\Support\Utils\Pagination\PaginationList;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Testing\TestResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use DateTime;
use Mockery;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use GenerateCNPJ, GenerateCPF, GenerateEmail, GeneratePassword;
    private array $data;

    public function bearerTokenInvalid(): string
    {
        return 'x4md1lfkewofqimvSKNDIEWHI@L';
    }

    public function authenticate(int $perfil): Collection
    {
        if ($perfil === 1):
            $credentials = $this->authenticateAdmin();
        else:
            $credentials = $this->authenticateCliente();
        endif;

        $auth = auth()->attempt($credentials);
        $user = auth()->user();

        return collect([
            'accessToken' => $auth,
            'userId' => $user->id,
            'userName' => $user->name,
            'userEmail' => $user->email,
            'role' => $user->role,
            'permissions' => $user->permissions->map(function ($permission) {
                return $permission->description;
            }),
        ]);
    }

    public function authenticateAdmin(): array
    {
        return [
            'email' => 'hildebrandolima16@gmail.com',
            'password' => 'HiLd3br@ndo'
        ];
    }

    public function authenticateCliente(): array
    {
        return [
            'email' => 'cliente@gmail.com',
            'password' => '@PClient5'
        ];
    }

    public function emailVerifiedAt(): string
    {
        return User::query()->whereNull('email_verificado_em')->first()->email;
    }

    public function httpStatusCode(TestResponse $response): int
    {
        return $response->baseResponse->original['status'];
    }

    public function baseResponse(TestResponse $response): string
    {
        return json_encode($response->baseResponse->original);
    }

    public function countPaginateList(TestResponse $response): int
    {
        return count($response->baseResponse->original['data']['list']);
    }

    public function paginationList(): Collection
    {
        return PaginationList::createFromPagination(new LengthAwarePaginator(400, 400, 10, null, []));
    }

    public function caseDate(string $dateRequest): bool
    {
        $date = DateTime::createFromFormat('Y-m-d H:i:s', $dateRequest);
        if ($date && $date->format('Y-m-d H:i:s') == $dateRequest):
            return true;
        else:
            return false;
        endif;
    }

    public function mask(int $value, string $format): string
    {
        $mask = '';
        $position_value = 0;
        for ($i = 0; $i <= strlen($format) - 1; $i++):
            if ($format[$i] == '#'):
                if (isset($value[$position_value])):
                    $mask .= $value[$position_value++];
                endif;
            else:
                $mask .= $format[$i];
            endif;
        endfor;
        return $mask;
    }

    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function setDataAuth(): array{
        return [
            'email' => 'hildebrandolima16@gmail.com',
            'password' => 'HiLd3br@ndo',
            'token' => Str::uuid(),
            'codigo' => Str::random(10),
            'senha' => $this->generatePassword()
        ];
    }

    public function setDataAddress(): array
    {
        return [
            'id' => 1,
            'logradouro' => Str::random(10),
            'numero' => rand(1000, 1000),
            'bairro' => Str::random(10),
            'cidade' => Str::random(10),
            'cep' => rand(10000, 20000) . '-' . rand(100, 200),
            'uf' => 'CE',
            'usuarioId' => 1,
            'fornecedorId' => 1,
            'ativo' => true
        ];
    }

    public function setDataCategory(): array
    {
        $this->data = [
            'id' => 1,
            'nome' => Str::random(10),
            'ativo' => true
        ];
        return $this->data;
    }

    public function setDataOrder(): array
    {
        $typeDelivery = array('Expresso', 'Correio', 'Retirada');
        $randKeys = array_rand($typeDelivery);
        return [
            'id' => 1,
            'quantidadeItens' => rand(10, 10),
            'total' => 50.99,
            'tipoEntrega' => $typeDelivery[$randKeys],
            'valorEntrega' => 4.5,
            'usuarioId' => 1,
            'ativo' => true,
            'itens' => [
                [
                    'id' => 1,
                    'nome' => Str::random(30),
                    'preco' => 15.30,
                    'quantidadeItem' => 1,
                    'subTotal' => 15.30,
                    'produtoId' => 1,
                    'ativo' => true
                ],
            ],
        ];
    }

    public function setDataPayment(): array
    {
        $typeCard = array('Crédito', 'Débito', 'NULL');
        $randKeysCard = array_rand($typeCard);
        $typePayment = array('Boleto Bancário', 'Crédito', 'Débito', 'Pix');
        $randKeysPayment = array_rand($typePayment);
        return [
            'id' => 1,
            'numeroCartao' => rand(100, 200) . ' ' . rand(100, 200) . ' ' . rand(100, 200) . ' ' . rand(100, 200) . ' ' . rand(100, 200),
            'tipoCartao' => $typeCard[$randKeysCard],
            'ccv' => rand(100, 100),
            'dataValidade' => date('Y-m-d H:i:s'),
            'parcela' => rand(1, 3),
            'total' => 20.0,
            'metodoPagamento' => $typePayment[$randKeysPayment],
            'pedidoId' => 1,
            'ativo' => true,
        ];
    }

    public function setDataProduct(): array
    {
        $unitMeasure = array('UN', 'G', 'KG', 'ML', 'L', 'M2', 'CX');
        $randKeys = array_rand($unitMeasure);
        return [
            'id' => 1,
            'nome' => Str::random(30),
            'precoCusto' => 15.30,
            'precoVenda' => 20.0,
            'codigoBarra' => Str::random(13),
            'descricao' => Str::random(100),
            'quantidade' => rand(10, 50),
            'unidadeMedida' => $unitMeasure[$randKeys],
            'dataValidade' => date('Y-m-d H:i:s'),
            'categoriaId' => 1,
            'fornecedorId' => 1,
            'ativo' => true,
        ];
    }

    public function setDataProvider(): array
    {
        return [
            'id' => 1,
            'razaoSocial' => Str::random(10),
            'cnpj' => $this->generateCNPJ(),
            'email' => $this->generateEmail(),
            'dataFundacao' => date('Y-m-d H:i:s'),
            'ativo' => true,
        ];
    }

    public function setDataPhone(): array
    {
        $type = array('Fixo', 'Celular');
        $randKeys = array_rand($type);
        return [
            [
                'id' => 1,
                'tipo' => $type[$randKeys],
                'ddd' => 85,
                'numero' => '(' . rand(10, 20) . ')9' . rand(1000, 2000) . '-' . rand(1000, 2000),
                'usuarioId' => 1,
                'fornecedorId' => 1,
                'ativo' => true
            ]
        ];
    }

    public function setDataUser(): array
    {
        $gender = array('Masculino', 'Feminino', 'Outro');
        $randKeys = array_rand($gender);
        return [
            'id' => 1,
            'nome' => Str::random(10),
            'cpf' => $this->generateCPF(),
            'email' => $this->generateEmail(),
            'password' => $this->generatePassword(),
            'dataNascimento' => date('Y-m-d H:i:s'),
            'genero' => $gender[$randKeys],
            'perfil' => RoleEnum::CLIENTE,
            'ativo' => true,
        ];
    }
}
