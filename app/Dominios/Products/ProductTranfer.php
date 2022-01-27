<?php

namespace App\Dominios\Products;

use App\Contracts\Suppliers\ProductRepositoryInterface;
use App\Dominios\Suppliers\SupplierTranfer;
use App\Models\ProductModel;

class ProductTranfer
{
    /**
     * @var ProductModel
     */
    private $productModel;

    /**
     * ProductTranfer constructor.
     * @param ProductModel $Product
     */
    private function __construct(ProductModel $Product)
    {
        $this->productModel = $Product;
    }

    /**
     * mapper ProductModel to entity of Product
     * @return Product
     */
    public function mapperToProduct() : Product
    {
        return (new Product(
            SupplierTranfer::create($this->productModel->supplier)->mapperToSupplier(),
            $this->productModel->name,
            $this->productModel->sku,
            $this->productModel->price,
            $this->productModel->stock,
        ))->setId($this->productModel->id)->setDescription($this->productModel->description);
    }

    /**
     * Creating a object Tranfer
     * @param $data
     * @return ProductTranfer
     */
    public static function create($data)
    {
        return new ProductTranfer($data);
    }

}
