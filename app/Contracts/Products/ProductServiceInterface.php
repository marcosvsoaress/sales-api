<?php

namespace App\Contracts\Products;


use App\Dominios\Products\Product;

interface ProductServiceInterface
{
    public function removeStock(Product $product, int $quant) : Product;
}
