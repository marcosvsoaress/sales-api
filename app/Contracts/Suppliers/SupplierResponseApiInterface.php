<?php

namespace App\Contracts\Suppliers;


use App\Contracts\Common\ResponseApiInterface;
use App\Dominios\Suppliers\Supplier;

interface SupplierResponseApiInterface extends ResponseApiInterface
{
    public function toResponse();

    public function toArray(Supplier $supplier);

    public static function create($data);

}
