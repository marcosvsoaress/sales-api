<?php

namespace App\Dominios\Products;

use App\Contracts\Products\ProductRepositoryInterface;
use App\Contracts\Suppliers\SupplierRepositoryInterface;
use App\Models\ProductModel;

class ProductRepository implements ProductRepositoryInterface
{
    private  $supplierRepository;

    /**
     * Create a new controller instance.
     *
     * @param SupplierRepositoryInterface $supplierRepository
     */
    public function __construct(SupplierRepositoryInterface $supplierRepository)
    {
        $this->supplierRepository = $supplierRepository;
    }

    /**
     * Create a new Product
     *
     * @param Product $product
     * @return Product
     */
    public function create(Product $product): Product
    {
        $productModel = new ProductModel();
        $productModel->supplier_id = $product->getSupplier()->getId();
        $productModel->name = $product->getName();
        $productModel->sku = $product->getSku();
        $productModel->description = $product->getDescription();
        $productModel->price = $product->getPrice();
        $productModel->stock = $product->getStock();
        $productModel->save();

        $product->setId($productModel->id);

        return $product;
    }

    /**
     * Get one Product by ID
     *
     * @param int $productId
     * @param int|null $supplierId
     * @return Product|null
     */
    public function get(int $productId, int $supplierId = null): ?Product
    {
        $productQuery = ProductModel::with('supplier')
            ->where('id', $productId);

        if($supplierId){
            $productQuery->where('supplier_id', $supplierId);
        }
        $productModel = $productQuery->first();
        return is_null($productModel) ? $productModel : ProductTranfer::create($productModel)->mapperToProduct();

    }

    /**
     * get all products
     *
     * @return array
     */
    public function getAll(): array
    {
        $productsModel = ProductModel::with('supplier')->get();
        $products = [];
        $productsModel->each(function ($productModel) use (&$products) {
            array_push($products, ProductTranfer::create($productModel)->mapperToProduct());
        });

        return $products;
    }

    /**
     * get all products by supplier
     *
     * @return array
     */
    public function getAllBySupplier(int $supplierId): array
    {
        $productsModel = ProductModel::where('supplier_id', $supplierId)->with('supplier');
        $products = [];
        $productsModel->each(function ($productModel) use (&$products) {
            array_push($products, ProductTranfer::create($productModel)->mapperToProduct());
        });

        return $products;
    }

    /**
     * Update a product
     *
     * @param Product $product
     * @return Product
     */
    public function update(Product $product): Product
    {
        $productModel = ProductModel::find($product->getId());
        $productModel->supplier_id = $product->getSupplier()->getId();
        $productModel->name = $product->getName();
        $productModel->sku = $product->getSku();
        $productModel->description = $product->getDescription();
        $productModel->price = $product->getPrice();
        $productModel->stock = $product->getStock();
        $productModel->save();

        return is_null($productModel) ? $productModel : ProductTranfer::create($productModel)->mapperToProduct();
    }

    /**
     * remove a product
     *
     * @param int $productId
     * @return bool
     */
    public function delete(int $productId, int $supplierId): bool
    {
        $productModel = ProductModel::where('id', $productId)->where('supplier_id', $supplierId)->first();
        return $productModel->delete();
    }
}
