<?php

namespace App\Data\Repositories\Product\Concretes;

use App\Data\Infra\Database\DBConnection;
use App\Data\Repositories\Product\Interfaces\IUpdateProductRepository;
use App\Domains\Traits\DefaultConditionActive;
use App\Exceptions\HttpInternalServerError;
use App\Models\Imagem;
use App\Models\Produto;
use Illuminate\Http\Exceptions\HttpResponseException;
use Exception;

class UpdateProductRepository extends DBConnection implements IUpdateProductRepository
{
    use DefaultConditionActive;

    private array $product;

    public function update(array $product): bool
    {
        try {
            $this->product = $product;
            $this->db->beginTransaction();
            $this->updateImage();
            $this->updateProduct();
            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw new HttpResponseException(HttpInternalServerError::getResponse($e));
        }
    }

    private function updateImage(): void
    {
        Imagem::query()
        ->where('produto_id', $this->product['id'])
        ->update([
            'ativo' => $this->defaultConditionActive($this->product['ativo'])
        ]);
    }

    private function updateProduct(): void
    {
        Produto::query()
        ->where('id', $this->product['id'])
        ->update([
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
            'ativo' => $this->defaultConditionActive($this->product['ativo'])
        ]);
    }
}
