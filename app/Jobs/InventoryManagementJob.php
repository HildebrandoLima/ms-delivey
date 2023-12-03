<?php

namespace App\Jobs;

use App\Models\Produto;
use App\Repositories\Concretes\EntityRepository;
use App\Repositories\Concretes\ProductRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Exception;

class InventoryManagementJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private array $items;
    private int $newQuantity;
    private ProductRepository $productRepository;
    private EntityRepository $entityRepository;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function handle(): void
    {
        try {
            $product = new EntityRepository();
            foreach($this->items as $item):
                $this->calculateQuantity($item);
                $productModel = $this->map($item['produtoId']);
                $product->update($productModel);
            endforeach;
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }

    private function calculateQuantity(array $item): int
    {
        $product = new ProductRepository();
        $currentQuantity = $product->readOne($item['produtoId'], 1)->toArray()[0]->quantidade;
        $quantity = $currentQuantity - $item['quantidadeItem'];
        $this->newQuantity = $quantity;
        return $this->newQuantity;
    }

    private function map(int $produtoId): Produto
    {
        $product = new Produto();
        $product->id = $produtoId;
        $product->quantidade = $this->newQuantity;
        return $product;
    }
}
