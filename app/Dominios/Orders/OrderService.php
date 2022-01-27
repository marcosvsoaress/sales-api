<?php

namespace App\Dominios\Orders;

use App\Dominios\Products\Product;

class OrderService
{

    public function totalOrder(Order $order)
    {
        return array_reduce($order->getItems(), function (int $carry, OrderItem $item) {
            $carry += $item->getQuantity() * $item->getSalePrice();
            return $carry;
        });
    }
}
