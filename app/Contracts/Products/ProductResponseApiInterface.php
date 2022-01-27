<?php

namespace App\Contracts\Products;


use App\Contracts\Common\ResponseApiInterface;
use App\Dominios\Products\Product;

interface ProductResponseApiInterface extends ResponseApiInterface
{
    public function toResponse();

    public function toArray(Product $supplier);

    public static function create($data);

}
