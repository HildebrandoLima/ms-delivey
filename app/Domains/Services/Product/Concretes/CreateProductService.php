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
    private float $precoCusto = 0;
    private float $precoVenda = 0;
    private array $product = [];

    public function __construct(ICreateProductRepository $createProductRepository)
    {
        $this->createProductRepository  = $createProductRepository;
    }

    public function create(CreateProductRequest $request): bool
    {
        $this->setRequest($request);
        $this->priceFormart();
        $this->map();
        return $this->created();
    }

    private function setRequest(CreateProductRequest $request): void
    {
        $this->request = $request;
    }

    private function priceFormart(): void
    {
        $this->precoCusto = str_replace(',', '.', PriceFormat::priceFormart($this->request->precoCusto));
        $this->precoVenda = str_replace(',', '.', PriceFormat::priceFormart($this->request->precoVenda));
    }

    private function directory(): string
    {
        return 'images/' . strtolower(str_replace(' ', '_', $this->request->nome));
    }

    private function map(): void
    {
        $this->product = [
            'nome' => $this->request->nome,
            'precoCusto' => $this->precoCusto,
            'precoVenda' => $this->precoVenda,
            'margemLucro' => $this->precoVenda - $this->precoCusto,
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

    private function created(): bool
    {
        return $this->createProductRepository->create($this->product);
    }
}
