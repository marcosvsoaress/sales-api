<?php

namespace App\Dominios\Transactions;

use App\Contracts\Transactions\GatewayPaymentInterface;
use App\Contracts\Transactions\TransactionRepositoryInterface;
use App\Contracts\Transactions\TransactionServiceInterface;
use App\Dominios\Orders\Order;

class TransactionService implements TransactionServiceInterface {

    /**
     * @var TransactionRepository
     */
    private $transactionRepository;

    /**
     * @var GatewayPaymentInterface
     */
    private $gatewayPayment;

    public function __construct(TransactionRepositoryInterface $transactionRepository, GatewayPaymentInterface $gatewayPayment)
    {
        $this->transactionRepository = $transactionRepository;
        $this->gatewayPayment = $gatewayPayment;
    }

    public function create(Order $order){
        $transaction = new Transaction($order, $order->getTotal(), $order->getMethodPayment());
        $transaction->setStatus(TransactionStatusEnum::AWAITING_PAYMENT);
        $this->transactionRepository->create($transaction);

        //Gateway payment
        $this->gatewayPayment->create($order);

    }
}
