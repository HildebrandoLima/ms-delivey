<?php

namespace App\Domains\Services\Product\Concretes;

use App\Data\Repositories\Product\Interfaces\ICreateProductRepository;
use App\Domains\Services\Product\Interfaces\ICreateProductService;
use App\Http\Requests\Product\CreateProductRequest;
use App\Support\Utils\PriceFormat\PriceFormat;

class CreateProductService implements ICreateProductService
{
    private ICreateProductRepository  $createProductRepository;
    private CreateProductRequest $request;

    public function __construct(ICreateProductRepository $createProductRepository)
    {
        $this->createProductRepository  = $createProductRepository;
    }

    public function create(CreateProductRequest $request): bool
    {
        $this->request = $request;
        return $this->createProductRepository->create($this->map());
    }

    private function map(): array
    {
        $precoCusto = str_replace(',', '.', PriceFormat::priceFormart($this->request->precoCusto));
        $precoVenda = str_replace(',', '.', PriceFormat::priceFormart($this->request->precoVenda));

        return [
            'nome' => $this->request->nome,
            'precoCusto' => $precoCusto,
            'precoVenda' => $precoVenda,
            'margemLucro' => $precoVenda - $precoCusto,
            'codigoBarra' => $this->request->codigoBarra,
            'descricao' => $this->request->descricao,
            'quantidade' => $this->request->quantidade,
            'unidadeMedida' => $this->request->unidadeMedida,
            'dataValidade' => $this->request->dataValidade,
            'categoriaId' => $this->request->categoriaId,
            'fornecedorId' => $this->request->fornecedorId,
            'directory' => $this->directory(),
            'imagens' => $this->request->imagens
        ];
    }

    private function directory(): string
    {
        return 'images/' . strtolower(str_replace(' ', '_', $this->request->nome));
    }
}
