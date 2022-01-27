<?php

namespace App\Dominios\Orders;

class OrderStatusEnum{
    CONST AWAITING_PAYMENT = 'awaiting payment';
    CONST PAYMENT_ACCEPT = 'payment accept';
    CONST CONCLUDED = 'concluded';
}
