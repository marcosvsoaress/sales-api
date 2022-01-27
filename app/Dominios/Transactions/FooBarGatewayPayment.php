<?php

namespace App\Dominios\Transactions;

use App\Contracts\Transactions\GatewayPaymentInterface;
use App\Dominios\Orders\Order;

class FooBarGatewayPayment implements GatewayPaymentInterface {

    public function create(Order $order): Order
    {
        // Here comes the integration with the chosen gateway
        return $order;
    }
}
