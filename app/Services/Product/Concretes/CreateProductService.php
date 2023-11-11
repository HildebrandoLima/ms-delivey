<?php

namespace App\Services\Product\Concretes;

use App\Http\Requests\Product\CreateProductRequest;
use App\Models\Imagem;
use App\Models\Produto;
use App\Repositories\Abstracts\IEntityRepository;
use App\Services\Product\Abstracts\ICreateProductService;
use App\Support\Enums\AtivoEnum;

class CreateProductService implements ICreateProductService
{
    private IEntityRepository $entityRepository;

    public function __construct(IEntityRepository $entityRepository)
    {
        $this->entityRepository = $entityRepository;
    }

    public function createProduct(CreateProductRequest $request): bool
    {
        $product = $this->mapProduct($request);
        $productId = $this->entityRepository->create($product);
        $this->createImage($request, $productId);
        return true;
    }

    private function formartPrice(string $preco): string
    {
        $firstDotPosition = strpos($preco, '.');
        if ($firstDotPosition !== false):
            $preco = substr_replace($preco, '', $firstDotPosition, 1);
        endif;
        return $preco;
    }

    private function mapProduct(CreateProductRequest $request): Produto
    {
        $precoCusto = str_replace(',', '.', $this->formartPrice($request->precoCusto));
        $precoVenda = str_replace(',', '.', $this->formartPrice($request->precoVenda));

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

    private function directory(string $productName): string
    {
        $swapSpaceForUnderline = str_replace(' ', '_', $productName);
        $changeUppercaseLettersToLowercaseLetters = strtolower($swapSpaceForUnderline);
        $nameDirectory = $changeUppercaseLettersToLowercaseLetters;
        $directory = 'images/' . $nameDirectory;
        return $directory;
    }

    private function createImage(CreateProductRequest $request, int $productId): bool
    {
        $uploadedImages = [];
        if ($request->hasFile('imagens')):
            $images = $request->file('imagens');
            $directory = $this->directory($request->nome);
            foreach ($images as $image):
                $imageName = $image->getClientOriginalName();
                $image->storeAs($directory, $imageName, 'public');
                $uploadedImages[] = $imageName;
                $imageModel = $this->mapImage($directory . '/' . $imageName, $productId);
                $this->entityRepository->create($imageModel);
            endforeach;
            return true;
        else:
            return false;
        endif;
    }

    private function mapImage(string $path, int $productId): Imagem
    {
        $image = new Imagem();
        $image->caminho = $path;
        $image->produto_id = $productId;
        $image->ativo = AtivoEnum::ATIVADO;
        return $image;
    }
}
