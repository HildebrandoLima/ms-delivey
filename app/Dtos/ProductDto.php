<?php

namespace App\Dtos;

use App\Support\Traits\DefaultFields;

class ProductDto 
{
    use DefaultFields;
    public int $produtoId = 0;
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
}
