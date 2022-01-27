<?php

namespace Tests\Unit;

use App\Dominios\Suppliers\Supplier;
use PHPUnit\Framework\TestCase;

class SupplierTest extends TestCase
{
    private $supplierData;

    protected function setUp(): void
    {
        $this->supplierData = [
            'company_name' => 'Google inc.',
            'trade_name' => 'Google',
            'cnpj' => '99.595.298/0001-97',
            'email' => 'google@google.com',
            'phone' => '(38) 9 9940-4855',
        ];
    }

    /**
     * @return void
     */
    public function test_create_supplier()
    {
        $supplier = new Supplier(
            $this->supplierData['company_name'],
            $this->supplierData['trade_name'],
            $this->supplierData['cnpj'],
            $this->supplierData['email'],
            $this->supplierData['phone'],
        );

        $this->assertEquals($this->supplierData['company_name'], $supplier->getCompanyName());
        $this->assertEquals($this->supplierData['trade_name'], $supplier->getTradeName());
        $this->assertEquals($this->supplierData['cnpj'], $supplier->getCnpj());
        $this->assertEquals($this->supplierData['email'], $supplier->getEmail());
        $this->assertEquals($this->supplierData['phone'], $supplier->getPhone());
    }

}
