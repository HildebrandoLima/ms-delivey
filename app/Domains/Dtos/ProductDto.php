<?php

namespace App\Domains\Dtos;

use App\Domains\Traits\Dtos\DefaultFields;
use App\Domains\Traits\Dtos\EntityProduct;

class ProductDto
{
    use DefaultFields, EntityProduct;

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
        $this->imagens = $this->images($data['imagem'] ?? []);
    }
}
