<?php

namespace App\Jobs;

use App\Data\Repositories\Product\Concretes\ListFindByIdProductRepository;
use App\Models\Produto;
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
    private Produto $product;
    private ListFindByIdProductRepository $listFindByIdProductRepository;
    private array $items = [];
    private int $newQuantity = 0, $productId = 0, $quantityItem = 0;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function handle(): void
    {
        try {
            $this->instantiate();
            foreach ($this->items as $item) {
                $this->setProduct($item['produtoId'], $item['quantidadeItem']);
                $this->processItem();   
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }

    private function instantiate(): void
    {
        $this->listFindByIdProductRepository = new ListFindByIdProductRepository();
    }

    private function processItem(): void
    {
        $this->getProduct();
        $this->calculateQuantity();
        $this->updated();
    }

    private function setProduct(int $productId, int $quantityItem): void
    {
        $this->productId = $productId;
        $this->quantityItem =  $quantityItem;
    }

    private function getProduct(): void
    {
        $this->product = $this->listFindByIdProductRepository->listFindById($this->productId, true)->first();
    }

    private function calculateQuantity(): void
    {
        if ($this->product) {
            $this->newQuantity = $this->product->quantidade - $this->quantityItem;
        }
    }

    private function updated(): void
    {
        Produto::query()
        ->where('id', $this->productId)
        ->update([
            'quantidade' => $this->newQuantity
        ]);
    }
}
