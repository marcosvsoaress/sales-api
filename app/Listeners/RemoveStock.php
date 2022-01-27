<?php

namespace App\Listeners;

use App\Contracts\Products\ProductServiceInterface;
use App\Dominios\Orders\OrderItem;
use App\Dominios\Products\ProductService;
use App\Dominios\Transactions\TransactionService;
use App\Events\ProcessOrder;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RemoveStock
{
    private $productService;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\ProcessOrder  $event
     * @return void
     */
    public function handle(ProcessOrder $event)
    {
        $itemsOrder = $event->order->getItems();
        /** @var OrderItem $item */
        foreach ($itemsOrder as $item){
            $this->productService->removeStock($item->getProduct(), $item->getQuantity());
        }
    }
}
