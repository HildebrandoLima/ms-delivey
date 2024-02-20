<?php

namespace App\Services\Product\Concretes;

use App\Http\Requests\Product\CreateProductRequest;
use App\Models\Imagem;
use App\Models\Produto;
use App\Repositories\Abstracts\IEntityRepository;
use App\Repositories\Abstracts\IProductRepository;
use App\Services\Product\Abstracts\ICreateProductService;
use App\Support\Enums\AtivoEnum;
use App\Support\Utils\PriceFormat\PriceFormat;

class CreateProductService implements ICreateProductService
{
    private IEntityRepository   $entityRepository;
    private IProductRepository  $productRepository;

    public function __construct(IEntityRepository $entityRepository, IProductRepository $productRepository)
    {
        $this->entityRepository  = $entityRepository;
        $this->productRepository = $productRepository;
    }

    public function createProduct(CreateProductRequest $request): bool
    {
        $product = $this->mapProduct($request);
        $productId = $this->entityRepository->create($product);
        if ($productId):
            $image = $this->createImage($request, $productId);
            if ($image):
                return true;
            else:
                $this->productRepository->delete($productId);
            return false;
            endif;
        else:
            return false;
        endif;
    }

    public function mapProduct(CreateProductRequest $request): Produto
    {
        $precoCusto = str_replace(',', '.', PriceFormat::priceFormart($request->precoCusto));
        $precoVenda = str_replace(',', '.', PriceFormat::priceFormart($request->precoVenda));

        $product = new Produto();
        $product->nome = $request->nome;
        $product->preco_custo = $precoCusto;
        $product->preco_venda = $precoVenda;
        $product->margem_lucro = $precoVenda - $precoCusto;
        $product->codigo_barra = $request->codigoBarra;
        $product->descricao = $request->descricao;
        $product->quantidade = $request->quantidade;
        $product->unidade_medida = $request->unidadeMedida;
        $product->data_validade = $request->dataValidade;
        $product->categoria_id = $request->categoriaId;
        $product->fornecedor_id = $request->fornecedorId;
        $product->ativo = AtivoEnum::ATIVADO;
        return $product;
    }

    public function directory(string $productName): string
    {
        $swapSpaceForUnderline = str_replace(' ', '_', $productName);
        $changeUppercaseLettersToLowercaseLetters = strtolower($swapSpaceForUnderline);
        $nameDirectory = $changeUppercaseLettersToLowercaseLetters;
        $directory = 'images/' . $nameDirectory;
        return $directory;
    }

    public function createImage(CreateProductRequest $request, int $productId): bool
    {
        $uploadedImages = [];
        if ($request['imagens']):
            $images = $request['imagens'];
            $directory = $this->directory($request->nome);
            foreach ($images as $image):
                if ($image->isValid()):
                    $imageName = $image->getClientOriginalName();
                    $image->storeAs($directory, $imageName, 'public');
                    $uploadedImages[] = $imageName;
                    $imageModel = $this->mapImage($directory . '/' . $imageName, $productId);
                    $this->entityRepository->create($imageModel);
                else:
                    return false;
                endif;
            endforeach;
            return true;
        else:
            return false;
        endif;
    }

    public function mapImage(string $path, int $productId): Imagem
    {
        $image = new Imagem();
        $image->caminho = $path;
        $image->produto_id = $productId;
        $image->ativo = AtivoEnum::ATIVADO;
        return $image;
    }
}
