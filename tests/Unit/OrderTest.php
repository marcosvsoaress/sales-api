<?php

namespace Tests\Unit;

use App\Dominios\Clients\Client;
use App\Dominios\Orders\Order;
use App\Dominios\Orders\OrderItem;
use App\Dominios\Orders\OrderStatusEnum;
use App\Dominios\Products\Product;
use App\Dominios\Suppliers\Supplier;
use Carbon\Carbon;
use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase
{
    private $clientData;
    private $orderData;
    private $supplierData;
    private $productData;
    private $itemsData;

    protected function setUp(): void
    {
        $this->clientData = [
            'name' => 'João Souza',
            'cpf' => '057.834.610-91',
            'phone' => '(38) 9 9910-5500',
            'email' => 'joao@email.com',
            'birth_date' => Carbon::createFromFormat('Y-m-d', '1986-06-25'),
        ];

        $this->orderData = [
            'status' => OrderStatusEnum::AWAITING_PAYMENT,
        ];

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

        $this->itemsData = [
            'quantity' => '10',
            'sale_price' => $this->productData['price'],
        ];
    }

    /**
     * @return void
     */
    public function test_create_order()
    {
        $client = (new Client(
            $this->clientData['name'],
            $this->clientData['cpf'],
            $this->clientData['phone'],
            $this->clientData['email']
        ))->setBirthDate($this->clientData['birth_date']);

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

        $items = [
            new OrderItem(
                $product,
                $this->itemsData['quantity'],
                $this->itemsData['sale_price'],
            )];

        $order = new Order(
            $client,
            $items,
            $this->orderData['status'],
        );

        //valid client
        $this->assertEquals($this->clientData['name'], $order->getClient()->getName());
        $this->assertEquals($this->clientData['cpf'], $order->getClient()->getCpf());
        $this->assertEquals($this->clientData['phone'], $order->getClient()->getPhone());
        $this->assertEquals($this->clientData['email'], $order->getClient()->getEmail());
        $this->assertEquals($this->clientData['birth_date']->format('Y-m-d'), $order->getClient()->getBirthDate()->format('Y-m-d'));

        //valid product
        $this->assertEquals($this->productData['name'], $order->getItems()[0]->getProduct()->getName());
        $this->assertEquals($this->productData['sku'], $order->getItems()[0]->getProduct()->getSku());
        $this->assertEquals($this->productData['price'], $order->getItems()[0]->getProduct()->getPrice());
        $this->assertEquals($this->productData['stock'], $order->getItems()[0]->getProduct()->getStock());

        //valid supplier
        $this->assertEquals($this->supplierData['company_name'], $order->getItems()[0]->getProduct()->getSupplier()->getCompanyName());
        $this->assertEquals($this->supplierData['trade_name'], $order->getItems()[0]->getProduct()->getSupplier()->getTradeName());
        $this->assertEquals($this->supplierData['cnpj'], $order->getItems()[0]->getProduct()->getSupplier()->getCnpj());
        $this->assertEquals($this->supplierData['email'], $order->getItems()[0]->getProduct()->getSupplier()->getEmail());
        $this->assertEquals($this->supplierData['phone'], $order->getItems()[0]->getProduct()->getSupplier()->getPhone());

        //valid order
        $this->assertEquals($this->orderData['status'], $order->getStatus());
    }

}
