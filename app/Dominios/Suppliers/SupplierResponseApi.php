<?php

namespace App\Dominios\Suppliers;

use App\Contracts\Suppliers\SupplierResponseApiInterface;
use App\Dominios\Common\ResponseApi;

class SupplierResponseApi extends ResponseApi implements SupplierResponseApiInterface
{
    private $data = null;

    private function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Creates a response Formated to be sending to the supplier
     *
     * @param bool $withHeader
     * @return array
     */
    public function toResponse($withHeader = true): array
    {
        if (is_null($this->data) || empty($this->data)) {
            return self::responseJson('Supplier not found');
        }

        $data = [];
        if (is_array($this->data)) {
            $suppliers = $this->responseList();
            if(!$withHeader){
                return $suppliers;
            }
            $data['suppliers'] = $suppliers;
        } else {
            $supplier = $this->toArray($this->data);
            if(!$withHeader){
                return $supplier;
            }
            $data['supplier'] = $supplier;
        }
        return self::responseJson('', $data);
    }

    /**
     * create a array of suppliers
     */
    private function responseList(){
        $suppliers = [];
        foreach ($this->data as $supplier) {
            array_push($suppliers, $this->toArray($supplier));
        }
        return $suppliers;
    }

    /**
     * format Object to Array
     *
     * @param Supplier $supplier
     * @return array
     */
    public function toArray(Supplier $supplier)
    {
        return [
            'id' => $supplier->getId(),
            'company_name' => $supplier->getCompanyName(),
            'trade_name' => $supplier->getTradeName(),
            'cnpj' => $supplier->getCnpj(),
            'email' => $supplier->getEmail(),
            'phone' => $supplier->getPhone(),
        ];
    }

    /**
     * Create a new SupplierResponse
     *
     * @param $data
     * @return SupplierResponseApi
     */
    public static function create($data)
    {
        return new SupplierResponseApi($data);
    }
}
