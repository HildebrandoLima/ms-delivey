<?php

namespace App\Domains\Dtos;

use App\Support\Traits\DefaultFields;
use App\Support\Utils\MapperDtos\EntityProduct;

class ProductDto
{
    use DefaultFields;
    public string $nome = "";
    public float $precoCusto = 0;
    public float $precoVenda = 0;
    public float $margemLucro = 0;
    public string $codigoBarra = "";
    public string $descricao = "";
    public int $quantidade = 0;
    public string $unidadeMedida = "";
    public string $dataValidade = "";
    public int $categoriaId = 0;
    public int $fornecedorId = 0;
    public array $imagens = [];

    public function customizeMapping(array $data): void
    {
        $this->mapCommonFields($data);
        $this->imagens = EntityProduct::images($data['imagem'] ?? []);
    }
}
