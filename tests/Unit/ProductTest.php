<?php

namespace Tests\Unit;
use App\Dominios\Products\Product;
use App\Dominios\Suppliers\Supplier;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    private $productData;
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

        $this->productData = [
            'name' => 'Mouse',
            'sku' => '84581',
            'price' => 99.59,
            'stock' => 1200,
        ];
    }

    /**
     * @return void
     */
    public function test_create_product()
    {
        $supplier = new Supplier(
            $this->supplierData['company_name'],
            $this->supplierData['trade_name'],
            $this->supplierData['cnpj'],
            $this->supplierData['email'],
            $this->supplierData['phone'],
        );

        $product = new Product(
            $supplier,
            $this->productData['name'],
            $this->productData['sku'],
            $this->productData['price'],
            $this->productData['stock'],
        );

        $this->assertEquals($this->supplierData['company_name'], $product->getSupplier()->getCompanyName());
        $this->assertEquals($this->supplierData['trade_name'], $product->getSupplier()->getTradeName());
        $this->assertEquals($this->supplierData['cnpj'], $product->getSupplier()->getCnpj());
        $this->assertEquals($this->supplierData['email'], $product->getSupplier()->getEmail());
        $this->assertEquals($this->supplierData['phone'], $product->getSupplier()->getPhone());

        $this->assertEquals($this->productData['name'], $product->getName());
        $this->assertEquals($this->productData['sku'], $product->getSku());
        $this->assertEquals($this->productData['price'], $product->getPrice());
        $this->assertEquals($this->productData['stock'], $product->getStock());
    }

    /**
     * @return void
     */
    public function test_create_product_with_description()
    {
        $supplier = new Supplier(
            $this->supplierData['company_name'],
            $this->supplierData['trade_name'],
            $this->supplierData['cnpj'],
            $this->supplierData['email'],
            $this->supplierData['phone'],
        );

        $product = new Product(
            $supplier,
            $this->productData['name'],
            $this->productData['sku'],
            $this->productData['price'],
            $this->productData['stock'],
        );

        $description = 'Preto, USB';
        $product->setDescription($description);

        $this->assertEquals($this->supplierData['company_name'], $product->getSupplier()->getCompanyName());
        $this->assertEquals($this->supplierData['trade_name'], $product->getSupplier()->getTradeName());
        $this->assertEquals($this->supplierData['cnpj'], $product->getSupplier()->getCnpj());
        $this->assertEquals($this->supplierData['email'], $product->getSupplier()->getEmail());
        $this->assertEquals($this->supplierData['phone'], $product->getSupplier()->getPhone());

        $this->assertEquals($this->productData['name'], $product->getName());
        $this->assertEquals($this->productData['sku'], $product->getSku());
        $this->assertEquals($this->productData['price'], $product->getPrice());
        $this->assertEquals($this->productData['stock'], $product->getStock());
        $this->assertEquals($description, $product->getDescription());
    }
}
