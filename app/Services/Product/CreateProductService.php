<?php

namespace App\Services\Product;

use App\Http\Requests\ProductRequest;
use App\Models\Imagem;
use App\Models\Produto;
use App\Repositories\CheckRegisterRepository;
use App\Repositories\ImageRepository;
use App\Repositories\ProductRepository;
use App\Services\Product\Interfaces\ICreateProductService;
use App\Support\Utils\Cases\ProductCase;
use App\Support\Utils\Enums\ProductEnum;

class CreateProductService implements ICreateProductService
{
    private ProductCase $productCase;
    private CheckRegisterRepository $checkRegisterRepository;
    private ProductRepository $productRepository;
    private ImageRepository $imageRepository;

    public function __construct
    (
        ProductCase             $productCase,
        CheckRegisterRepository $checkRegisterRepository,
        ProductRepository       $productRepository,
        ImageRepository         $imageRepository
    )
    {
        $this->productCase             = $productCase;
        $this->checkRegisterRepository = $checkRegisterRepository;
        $this->productRepository       = $productRepository;
        $this->imageRepository         = $imageRepository;
    }

    public function createProduct(ProductRequest $request): bool
    {
        $this->request = $request;
        $this->checkRegisterRepository->checkProductExist($request);
        $this->checkRegisterRepository->checkProviderIdExist($request->fornecedorId);
        $product = $this->mapToModelProduct();
        $productId = $this->productRepository->insert($product);
        $this->validatedImage($productId);
        return true;
    }

    private function mapToModelProduct(): Produto
    {
        $product = new Produto();
        $product->nome = $this->request->nome;
        $product->preco_custo = $this->request->precoCusto;
        $product->margem_lucro = ($this->request->precoVenda - $this->request->precoCusto);
        $product->preco_venda = $this->request->precoVenda;
        $product->codigo_barra = $this->request->codigoBarra;
        $product->descricao = $this->request->descricao;
        $product->quantidade = $this->request->quantidade;
        $product->unidade_medida = $this->productCase->productCase($this->request->unidadeMedida);
        $product->data_validade = $this->request->dataValidade;
        $product->categoria_id = $this->request->categoriaId;
        $product->fornecedor_id = $this->request->fornecedorId;
        $product->ativo = ProductEnum::ATIVADO;
        return $product;
    }

    private function validatedImage(int $productId): void
    {
        $images = $this->request->file('imagens');
        if (isset ($images)):
            foreach ($images as $image):
                $path = $image->store('images', 'public');
                $image = $this->mapToModelImage($path, $productId);
                $this->imageRepository->insert($image);
            endforeach;
        endif;
    }

    private function mapToModelImage(string $path, int $productId): Imagem
    {
        $image = new Imagem();
        $image->caminho = $path;
        $image->produto_id = $productId;
        $image->ativo = ProductEnum::ATIVADO;
        return $image;
    }
}
