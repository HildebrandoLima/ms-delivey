<?php

namespace App\Domains\Services\Product\Concretes;

use App\Data\Repositories\Product\Interfaces\IUpdateProductRepository;
use App\Domains\Services\Product\Interfaces\IUpdateProductService;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Support\Utils\PriceFormat\PriceFormat;

class UpdateProductService implements IUpdateProductService
{
    private IUpdateProductRepository $updateProductRepository;
    private UpdateProductRequest $request;
    private float $precoCusto = 0;
    private float $precoVenda = 0;
    private array $product = [];

    public function __construct(IUpdateProductRepository $updateProductRepository)
    {
        $this->updateProductRepository = $updateProductRepository;
    }

    public function update(UpdateProductRequest $request): bool
    {
        $this->setRequest($request);
        $this->priceFormart();
        $this->map();
        return $this->updated();
    }

    private function setRequest(UpdateProductRequest $request): void
    {
        $this->request = $request;
    }

    private function priceFormart(): void
    {
        $this->precoCusto = str_replace(',', '.', PriceFormat::priceFormart($this->request->precoCusto));
        $this->precoVenda = str_replace(',', '.', PriceFormat::priceFormart($this->request->precoVenda));
    }

    private function map(): void
    {
        $this->product =  [
            'id' => $this->request->id,
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
            'ativo' => $this->request->ativo
        ];
    }
    
    private function updated(): bool
    {
        return $this->updateProductRepository->update($this->product);
    }
}
