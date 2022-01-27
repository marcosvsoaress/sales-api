<?php

namespace App\Http\Controllers;

use App\Contracts\Suppliers\SupplierRepositoryInterface;
use App\Dominios\Suppliers\Supplier;
use App\Dominios\Suppliers\SupplierRepository;
use App\Dominios\Suppliers\SupplierResponseApi;
use App\Http\Requests\Suppliers\StoreSupplierRequest;
use App\Http\Requests\Suppliers\UpdateSupplierRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class SupplierController extends Controller
{
    /**
     * @var SupplierRepository
     */
    private $supplierRepository;

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
     * Get all supplier
     *
     * @return JsonResponse
     */
    public function index()
    {
        $suppliers = $this->supplierRepository->getAll();
        return response()->json(SupplierResponseApi::create($suppliers)->toResponse(), 200);
    }

    /**
     * Get one supplier
     *
     * @param $idSupplier
     * @return JsonResponse
     */
    public function show($idSupplier)
    {
        $supplier = $this->supplierRepository->get($idSupplier);
        return response()->json(SupplierResponseApi::create($supplier)->toResponse(), 200);
    }

    /**
     * Create a new supplier
     *
     * @param StoreSupplierRequest $request
     * @return JsonResponse
     */
    public function store(StoreSupplierRequest $request)
    {
        $supplier = new Supplier(
            $request->company_name,
            $request->trade_name,
            $request->cnpj,
            $request->email,
            $request->phone
        );

        try {
            $supplier = $this->supplierRepository->create($supplier);
        } catch (\Exception $e) {
            Log::error($e->getMessage(), $e->getTrace());
            $message = 'It was not possible create supplier data';
            return response()->json(SupplierResponseApi::errorResponseJson($message), 500);
        }

        return response()->json(SupplierResponseApi::create($supplier)->toResponse(), 201);
    }

    /**
     * Update a supplier existing
     *
     * @param UpdateSupplierRequest $request
     * @param $idSupplier
     * @return JsonResponse
     */
    public function update(UpdateSupplierRequest $request, $idSupplier)
    {
        /**
         * @var Supplier
         */
        $supplier = $this->supplierRepository->get($idSupplier);

        if(is_null($supplier)){
            return response()->json(SupplierResponseApi::create($supplier)->toResponse(), 204);
        }

        if ($request->company_name) {
            $supplier->setCompanyName($request->company_name);
        }

        if ($request->trade_name) {
            $supplier->setTradeName($request->trade_name);
        }

        if ($request->cnpj) {
            $supplier->setCnpj($request->cnpj);
        }

        if ($request->email) {
            $supplier->setEmail($request->email);
        }

        if ($request->phone) {
            $supplier->setPhone($request->phone);
        }

        try {
            $supplier = $this->supplierRepository->update($supplier);
        } catch (\Exception $e) {
            Log::error($e->getMessage(), $e->getTrace());
            $message = 'It was not possible update supplier data';
            return response()->json(SupplierResponseApi::errorResponseJson($message), 500);
        }

        return response()->json(SupplierResponseApi::create($supplier)->toResponse(), 200);
    }

    /**
     * Remove supplier
     *
     * @param $supplierId
     * @return JsonResponse
     */
    public function destroy($supplierId){
        try {
            if($this->supplierRepository->delete($supplierId)){
                return response()->json(SupplierResponseApi::responseJson('The supplier has been removed'));
            }else{
                return response()->json(SupplierResponseApi::responseJson('It was not possible remove supplier data'));
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage(), $e->getTrace());
            $message = 'It was not possible remove supplier data';
            return response()->json(SupplierResponseApi::errorResponseJson($message), 500);
        }
    }
}
