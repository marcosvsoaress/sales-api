<?php

namespace App\Contracts\Orders;

use App\Dominios\Orders\Order;

interface OrderRepositoryInterface
{
    /**
     * @param Order $order
     * @return Order
     */
    public function create(Order $order) : Order;

    /**
     * @param int $orderId
     * @return Order|null
     */
    public function get(int $orderId) : ?Order;

    /**
     * @param Order $order
     * @return Order
     */
    public function updateStatus(Order $order) : Order;
}
