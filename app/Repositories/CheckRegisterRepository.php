<?php

namespace App\Repositories;

use App\Exceptions\HttpBadRequest;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProviderRequest;
use App\Http\Requests\UserRequest;
use App\Models\Categoria;
use App\Models\Endereco;
use App\Models\Fornecedor;
use App\Models\Imagem;
use App\Models\Pedido;
use App\Models\Produto;
use App\Models\Telefone;
use App\Models\User;
use App\Repositories\Interfaces\ICheckRegisterRepository;

class CheckRegisterRepository implements ICheckRegisterRepository {
    public function checkAddressIdExist(int $id): void
    {
        if (Endereco::query()->where('id', $id)
            ->orWhere(function ($query) use ($id) {
                $query->where('usuario_id', $id)
                    ->orWhere(function ($query) use ($id) {
                        $query->where('fornecedor_id', $id);
                    });
            })->count() == 0):
            throw new HttpBadRequest('O código do endereço informado não existe.');
        endif;
    }

    public function checkCategoryExist(CategoryRequest $request): void
    {
        if (Categoria::query()
                ->where('nome', 'like', $request->nome)
                ->count() != 0):
            throw new HttpBadRequest('A categoria informada já existe.');
        endif;
    }

    public function checkCategoryIdExist(int $id): void
    {
        if (Categoria::query()->where('id', $id)->count() == 0):
            throw new HttpBadRequest('A categoria informada não existe');
        endif;
    }

    public function checkOrderIdExist(int $id): void
    {
        if (Pedido::query()->where('id', $id)->count() == 0):
            throw new HttpBadRequest('O pedido informado não existe.');
        endif;
    }

    public function checkProductExist(ProductRequest $request): void
    {
        if (Produto::query()->where('nome', 'like', $request->nome)
                ->orWhere('codigo_barra', '=', $request->codigoBarra)
                ->count() != 0):
            throw new HttpBadRequest('O produto informado já existe.');
        endif;
    }

    public function checkProductIdExist(int $id): void
    {
        if (Produto::query()->where('id', $id)->count() == 0):
            throw new HttpBadRequest('O produto informado não existe.');
        endif;
    }

    public function checkImageIdExist(int $id): void
    {
        if (Imagem::query()->where('id', $id)->count() == 0):
            throw new HttpBadRequest('A imagem informada não existe.');
        endif;
    }

    public function checkProviderExist(ProviderRequest $request): void
    {
        if (Fornecedor::query()
                ->where('razao_social', 'like', $request->razaoSocial)
                ->orWhere(function ($query) use ($request) {
                    $query->where('cnpj', '=', $request->cnpj)
                        ->orWhere(function ($query) use ($request) {
                            $query->where('email', 'like', $request->email);
                        });
                })
                ->count() != 0):
            throw new HttpBadRequest('O fornecedor informado já existe.');
        endif;
    }

    public function checkProviderIdExist(int $id): void
    {
        if (Fornecedor::query()->where('id', $id)->count() == 0):
            throw new HttpBadRequest('O fornecedor informado não existe.');
        endif;
    }

    public function checkTelephoneExist(string $numero): void
    {
        if (Telefone::query()
                ->where('numero', 'like', $numero)
                ->count() != 0):
            throw new HttpBadRequest('O número informado já existe.', (int)$numero);
        endif;
    }

    public function checkTelephoneIdExist(int $id): void
    {
        if (Telefone::query()->where('id', $id)
                ->orWhere(function ($query) use ($id) {
                    $query->where('usuario_id', $id)
                        ->orWhere(function ($query) use ($id) {
                            $query->where('fornecedor_id', $id);
                        });
             })->count() == 0):
            throw new HttpBadRequest('O código de telefone informado não existe.');
        endif;
    }

    public function checkUserExist(UserRequest $request): void
    {
        if (User::query()->where('name', 'like', $request->nome)
                ->orWhere(function ($query) use ($request) {
                    $query->where('cpf', '=', $request->cpf)
                        ->orWhere(function ($query) use ($request) {
                            $query->where('email', 'like', $request->email);
                        });
                })->count() != 0):
            throw new HttpBadRequest('O usuário informado já existe.');
        endif;
    }

    public function checkUserIdExist(int $id): void
    {
        if (User::query()->where('id', $id)->count() == 0):
            throw new HttpBadRequest('O usuário informado não existe.');
        endif;
    }
}
