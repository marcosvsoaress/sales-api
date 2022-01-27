<?php

namespace App\Contracts\Orders;


use App\Contracts\Common\ResponseApiInterface;
use App\Dominios\Orders\Order;

interface OrderResponseApiInterface extends ResponseApiInterface
{
    public function toResponse();

    public function toArray(Order $order);

    public static function create($data);

}
