<?php

namespace App\Dominios\Products;

use App\Contracts\Products\ProductResponseApiInterface;
use App\Dominios\Common\ResponseApi;
use App\Dominios\Suppliers\SupplierResponseApi;

class ProductResponseApi extends ResponseApi implements ProductResponseApiInterface
{
    private $data = null;

    private function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Creates a response Formated to be sending to the product
     *
     * @param bool $withHeader
     * @return array
     */
    public function toResponse($withHeader = true)
    {
        if (is_null($this->data) || empty($this->data)) {
            if(!$withHeader){
                return [];
            }
            return self::responseJson('Product not found');
        }

        $data = [];
        if (is_array($this->data)) {
            $products = $this->responseList();
            if(!$withHeader){
                return $products;
            }
            $data['products'] = $products;
        } else {
            $product = $this->toArray($this->data);
            if(!$withHeader){
                return $product;
            }
            $data['product'] = $product;
        }
        return self::responseJson('', $data);
    }

    /**
     * create a array of products
     */
    private function responseList(){
        $products = [];
        foreach ($this->data as $product) {
            array_push($products, $this->toArray($product));
        }
        return $products;
    }

    /**
     * format Object to Array
     *
     * @param Product $product
     * @return array
     */
    public function toArray(Product $product)
    {
        return [
            'id' => $product->getId(),
            'name' => $product->getName(),
            'sku' => $product->getSku(),
            'description' => $product->getDescription(),
            'price' => $product->getPrice(),
            'stock' => $product->getStock(),
            'supplier' => SupplierResponseApi::create($product->getSupplier())->toResponse(false),
        ];
    }

    /**
     * Create a new ProductResponse
     *
     * @param $data
     * @return ProductResponseApi
     */
    public static function create($data)
    {
        return new ProductResponseApi($data);
    }
}
