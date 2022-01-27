<?php

namespace App\Contracts\Transactions;

use App\Dominios\Orders\Order;

interface GatewayPaymentInterface
{
    /**
     * @param Order $order
     * @return Order
     */
    public function create(Order $order): Order;
}
