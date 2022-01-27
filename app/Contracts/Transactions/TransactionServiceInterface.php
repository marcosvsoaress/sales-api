<?php

namespace App\Contracts\Transactions;

use App\Dominios\Orders\Order;

interface TransactionServiceInterface
{
    public function create(Order $order);
}
