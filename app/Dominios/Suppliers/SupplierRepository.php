<?php

namespace App\Dominios\Suppliers;

use App\Contracts\Suppliers\SupplierRepositoryInterface;
use App\Models\SupplierModel;

class SupplierRepository implements SupplierRepositoryInterface
{

    /**
     * Create a new Supplier
     *
     * @param Supplier $supplier
     * @return Supplier
     */
    public function create(Supplier $supplier): Supplier
    {
        $supplierModel = new SupplierModel();
        $supplierModel->company_name = $supplier->getCompanyName();
        $supplierModel->trade_name = $supplier->getTradeName();
        $supplierModel->cnpj = $supplier->getCnpj();
        $supplierModel->email = $supplier->getEmail();
        $supplierModel->phone = $supplier->getPhone();
        $supplierModel->save();

        return is_null($supplierModel) ? $supplierModel : SupplierTranfer::create($supplierModel)->mapperToSupplier();
    }

    /**
     * Get one Supplier by ID
     *
     * @param int $supplierId
     * @return Supplier|null
     */
    public function get(int $supplierId): ?Supplier
    {
        $supplierModel = SupplierModel::where('id', $supplierId)->first();
        return is_null($supplierModel) ? $supplierModel : SupplierTranfer::create($supplierModel)->mapperToSupplier();

    }

    /**
     * get all suppliers
     *
     * @return array
     */
    public function getAll(): array
    {
        $suppliersModel = SupplierModel::all();
        $suppliers = [];
        $suppliersModel->each(function ($supplierModel) use (&$suppliers) {
            array_push($suppliers, SupplierTranfer::create($supplierModel)->mapperToSupplier());
        });

        return $suppliers;
    }

    /**
     * Update a supplier
     *
     * @param Supplier $supplier
     * @return Supplier
     */
    public function update(Supplier $supplier): Supplier
    {

        $supplierModel = SupplierModel::find($supplier->getId());
        $supplierModel->company_name = $supplier->getCompanyName();
        $supplierModel->trade_name = $supplier->getTradeName();
        $supplierModel->cnpj = $supplier->getCnpj();
        $supplierModel->email = $supplier->getEmail();
        $supplierModel->phone = $supplier->getPhone();
        $supplierModel->save();

        $supplier->setId($supplierModel->id);
        return $supplier;
    }

    /**
     * remove a supplier
     *
     * @param int $supplierId
     * @return bool
     */
    public function delete(int $supplierId): bool
    {
        $supplierModel = SupplierModel::find($supplierId);
        return $supplierModel->delete();
    }
}
