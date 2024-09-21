<?php

namespace App\Data\Repositories\Product\Concretes;

use App\Data\Infra\Database\DBConnection;
use App\Data\Repositories\Product\Interfaces\ICreateProductRepository;
use App\Domains\Traits\DefaultConditionActive;
use App\Exceptions\HttpInternalServerError;
use App\Models\Imagem;
use App\Models\Produto;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\UploadedFile;
use Exception;

class CreateProductRepository extends DBConnection implements ICreateProductRepository
{
    use DefaultConditionActive;

    private array $product = [];
    private int $productId = 0;
    private string $path = '';
    private string $directory = '';
    private array $uploadedImages = [];

    public function create(array $product): bool
    {
        try {
            $this->product = $product;
            $this->db->beginTransaction();
            $this->createProduct();
            $this->uploadFile();
            $this->createImage();
            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw new HttpResponseException(HttpInternalServerError::getResponse($e));
        }
    }

    private function createProduct(): void
    {
        $this->productId = Produto::query()
        ->create([
            'nome' => $this->product['nome'],
            'preco_custo' => $this->product['precoCusto'],
            'preco_venda' => $this->product['precoVenda'],
            'margem_lucro' => $this->product['margemLucro'],
            'codigo_barra' => $this->product['codigoBarra'],
            'descricao' => $this->product['descricao'],
            'quantidade' => $this->product['quantidade'],
            'unidade_medida' => $this->product['unidadeMedida'],
            'data_validade' => $this->product['dataValidade'],
            'categoria_id' => $this->product['categoriaId'],
            'fornecedor_id'=> $this->product['fornecedorId'],
            'ativo' => $this->defaultConditionActive(true)
        ])->orderBy('id', 'desc')->first()->id;
    }

    private function uploadFile(): void
    {
        $images = $this->product['imagens'];
        if (!empty($images)) {
            $this->directory = $this->product['directory'];

            foreach ($images as $image) {
                if ($image->isValid()) {
                    $this->storeImage($image);
                }
            }

        }
    }

    private function storeImage(UploadedFile $image): void
    {
        $originalName = $image->getClientOriginalName();
        $imageName = str_replace(' ', '_', $originalName);
        $image->storeAs($this->directory, $imageName, 'public');
        $this->uploadedImages[] = $imageName;
        $this->path = $this->directory . '/' . $imageName;
        $this->createImage();
    }

    private function createImage(): void
    {
        Imagem::query()
        ->create([
            'caminho' => $this->path,
            'produto_id'=> $this->productId,
            'ativo' => $this->defaultConditionActive(true)
        ]);
    }
}
