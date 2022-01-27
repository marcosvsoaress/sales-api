<?php

namespace App\Contracts\Suppliers;

use App\Dominios\Suppliers\Supplier;

interface SupplierRepositoryInterface
{
    /**
     * @param Supplier $supplier
     * @return Supplier
     */
    public function create(Supplier $supplier) : Supplier;

    /**
     * @param int $supplierId
     * @return Supplier
     */
    public function get(int $supplierId) : ?Supplier;

    /**
     * @return array
     */
    public function getAll() : array;

    /**
     * @param Supplier $supplier
     * @return Supplier
     */
    public function update(Supplier $supplier) : Supplier;

    /**
     * @param int $supplierId
     * @return bool
     */
    public function delete(int $supplierId) : bool;
}
