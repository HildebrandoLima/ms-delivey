<?php

namespace App\Domains\Services\Product\Concretes;

use App\Data\Repositories\Product\Interfaces\IUpdateProductRepository;
use App\Domains\Services\Product\Abstracts\IEditProductService;
use App\Http\Requests\Product\EditProductRequest;
use App\Support\Utils\PriceFormat\PriceFormat;

class EditProductService implements IEditProductService
{
    private IUpdateProductRepository $updateProductRepository;
    private EditProductRequest $request;

    public function __construct(IUpdateProductRepository $updateProductRepository)
    {
        $this->updateProductRepository = $updateProductRepository;
    }

    public function editProduct(EditProductRequest $request): bool
    {
        $this->request = $request;
        return $this->updateProductRepository->update($this->map());
    }
    private function map(): array
    {
        $precoCusto = str_replace(',', '.', PriceFormat::priceFormart($this->request->precoCusto));
        $precoVenda = str_replace(',', '.', PriceFormat::priceFormart($this->request->precoVenda));

        return [
            'id' => $this->request->id,
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
            'ativo' => $this->request->ativo
        ];
    }
}
