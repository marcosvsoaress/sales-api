<?php

namespace App\Dominios\Orders;

use App\Dominios\Products\Product;

class OrderItem
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var Product
     */
    private $product;

    /**
     * @var int
     */
    private $quantity;

    /**
     * @var float
     */
    private $sale_price;

    public function __construct(Product $product, int $quantity, float $sale_price)
    {
        $this->product = $product;
        $this->quantity = $quantity;
        $this->sale_price = $sale_price;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return OrderItem
     */
    public function setId(int $id): OrderItem
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @param Product $product
     * @return OrderItem
     */
    public function setProduct(Product $product): OrderItem
    {
        $this->product = $product;
        return $this;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     * @return OrderItem
     */
    public function setQuantity(int $quantity): OrderItem
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @return float
     */
    public function getSalePrice(): float
    {
        return $this->sale_price;
    }

    /**
     * @param float $sale_price
     * @return OrderItem
     */
    public function setSalePrice(float $sale_price): OrderItem
    {
        $this->sale_price = $sale_price;
        return $this;
    }


}
