<?php

namespace App\Dominios\Products;

use App\Contracts\Products\ProductRepositoryInterface;
use App\Contracts\Products\ProductServiceInterface;

class ProductService implements ProductServiceInterface
{
    /**
     * @var ProductRepository
     */
    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function removeStock(Product $product, int $quant) : Product
    {
        $product->setStock($product->getStock() - $quant);
        return $this->productRepository->update($product);
    }

    public function hasStock(Product $product, int $wanted): bool
    {
        if ($product->getStock() > $wanted) return true;
        return false;
    }
}
