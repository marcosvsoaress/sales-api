<?php

namespace App\Http\Controllers;

use App\Contracts\Products\ProductRepositoryInterface;
use App\Contracts\Suppliers\SupplierRepositoryInterface;
use App\Dominios\Products\Product;
use App\Dominios\Products\ProductRepository;
use App\Dominios\Products\ProductResponseApi;
use App\Dominios\Suppliers\SupplierRepository;
use App\Http\Requests\Products\StoreProductRequest;
use App\Http\Requests\Products\UpdateProductRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * @var SupplierRepository
     */
    private $supplierRepository;

    /**
     * Create a new controller instance.
     *
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(ProductRepositoryInterface $productRepository, SupplierRepositoryInterface $supplierRepository)
    {
        $this->productRepository = $productRepository;
        $this->supplierRepository = $supplierRepository;
    }

    /**
     * Get all product
     *
     * @return JsonResponse
     */
    public function index()
    {
        $products = $this->productRepository->getAll();
        return response()->json(ProductResponseApi::create($products)->toResponse(), 200);
    }

    /**
     * Get all product by supplier
     *
     * @param $supplierId
     * @return JsonResponse
     */
    public function listBySupplier($supplierId){
        $products = $this->productRepository->getAllBySupplier($supplierId);
        return response()->json(ProductResponseApi::create($products)->toResponse(), 200);
    }

    /**
     * Get one product
     *
     * @param $idProduct
     * @return JsonResponse
     */
    public function show($supplierId, $productId)
    {
        $product = $this->productRepository->get($productId, $supplierId);
        return response()->json(ProductResponseApi::create($product)->toResponse(), 200);
    }

    /**
     * Create a new product
     *
     * @param StoreProductRequest $request
     * @return JsonResponse
     */
    public function store(StoreProductRequest $request, $supplierId)
    {
        $supplier = $this->supplierRepository->get($supplierId);

        if(!$supplier){
            $message = 'It was not possible create product data';
            return response()->json(ProductResponseApi::errorResponseJson($message), 500);
        }

        $product = new Product(
            $supplier,
            $request->name,
            $request->sku,
            $request->price,
            $request->stock
        );

        if (!empty($request->description)) {
            $product->setDescription($request->description);
        }

        try {
            $product = $this->productRepository->create($product);
        } catch (\Exception $e) {
            Log::error($e->getMessage(), $e->getTrace());
            $message = 'It was not possible create product data';
            return response()->json(ProductResponseApi::errorResponseJson($message), 500);
        }

        return response()->json(ProductResponseApi::create($product)->toResponse(), 201);
    }

    /**
     * Update a product existing
     *
     * @param UpdateProductRequest $request
     * @param $idProduct
     * @return JsonResponse
     */
    public function update(UpdateProductRequest $request, $supplierId, $idProduct)
    {
        /**
         * @var Product
         */
        $product = $this->productRepository->get($idProduct, $supplierId);

        if (is_null($product)) {
            return response()->json(ProductResponseApi::create($product)->toResponse(), 204);
        }

        if ($request->name) {
            $product->setName($request->name);
        }

        if ($request->sku) {
            $product->setSku($request->sku);
        }

        if ($request->description) {
            $product->setDescription($request->description);
        }

        if ($request->price) {
            $product->setPrice($request->price);
        }

        if ($request->stock) {
            $product->setStock($request->stock);
        }

        try {
            $product = $this->productRepository->update($product);
        } catch (\Exception $e) {
            Log::error($e->getMessage(), $e->getTrace());
            $message = 'It was not possible update product data';
            return response()->json(ProductResponseApi::errorResponseJson($message), 500);
        }

        return response()->json(ProductResponseApi::create($product)->toResponse(), 200);
    }

    /**
     * Remove product
     *
     * @param $productId
     * @return JsonResponse
     */
    public function destroy($supplierId, $productId)
    {
        try {
            if ($this->productRepository->delete($productId, $supplierId)) {
                return response()->json(ProductResponseApi::responseJson('The product has been removed'));
            } else {
                return response()->json(ProductResponseApi::responseJson('It was not possible remove product data'));
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage(), $e->getTrace());
            $message = 'It was not possible remove product data';
            return response()->json(ProductResponseApi::errorResponseJson($message), 500);
        }
    }
}
