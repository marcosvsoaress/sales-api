<?php

namespace App\Contracts\Products;

use App\Dominios\Products\Product;

interface ProductRepositoryInterface
{
    /**
     * @param Product $product
     * @return Product
     */
    public function create(Product $product) : Product;

    /**
     * @param int $productId
     * @param int|null $supplierId
     * @return Product
     */
    public function get(int $productId, int $supplierId = null) : ?Product;

    /**
     * @return array
     */
    public function getAll() : array;

    /**
     * @param int $supplierId
     * @return array
     */
    public function getAllBySupplier(int $supplierId): array;

    /**
     * @param Product $product
     * @return Product
     */
    public function update(Product $product) : Product;

    /**
     * @param int $productId
     * @param int $supplierId
     * @return bool
     */
    public function delete(int $productId, int $supplierId) : bool;
}
