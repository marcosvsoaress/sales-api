<?php

namespace App\Listeners;

use App\Contracts\Transactions\TransactionServiceInterface;
use App\Dominios\Orders\Order;
use App\Dominios\Transactions\TransactionService;
use App\Events\ProcessOrder;

class CreateTransaction
{
    /**
     * @var TransactionService
     */
    private $transactionService;

    /**
     * Create the event listener.
     *
     * @param TransactionServiceInterface $transactionService
     */
    public function __construct(TransactionServiceInterface $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\ProcessOrder  $event
     * @return void
     */
    public function handle(ProcessOrder $event)
    {
        /** @var Order $order */
        $order = $event->order;
        $this->transactionService->create($order);
    }
}
