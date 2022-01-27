<?php

namespace App\Dominios\Suppliers;

use App\Models\SupplierModel;

class SupplierTranfer
{
    /**
     * @var SupplierModel
     */
    private $supplierModel;

    private function __construct($Supplier)
    {
        $this->supplierModel = $Supplier;
    }

    /**
     * mapper SupplierModel to entity of Supplier
     * @return Supplier
     */
    public function mapperToSupplier() : Supplier
    {
        return (new Supplier(
            $this->supplierModel->company_name,
            $this->supplierModel->trade_name,
            $this->supplierModel->cnpj,
            $this->supplierModel->email,
            $this->supplierModel->phone
        ))->setId($this->supplierModel->id);
    }

    /**
     * Creating a object Tranfer
     * @param $data
     * @return SupplierTranfer
     */
    public static function create($data)
    {
        return new SupplierTranfer($data);
    }

}
