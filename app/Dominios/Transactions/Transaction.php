<?php

namespace App\Dominios\Transactions;

use App\Dominios\Orders\Order;
use App\Models\TransactionModel;

class Transaction{

    /**
     * @var int
     */
    private $id;

    /**
     * @var Order
     */
    private $order;

    /**
     * @var float
     */
    private $total;

    /**
     * @var string
     */
    private $method_payment;

    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $transaction_id;

    public function __construct(Order $order, float $total, string $method_payment)
    {
        $this->total = $total;
        $this->method_payment = $method_payment;
        $this->order = $order;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Order
     */
    public function getOrder(): Order
    {
        return $this->order;
    }

    /**
     * @param Order $order
     * @return Transaction
     */
    public function setOrder(Order $order): Transaction
    {
        $this->order = $order;
        return $this;
    }

    /**
     * @param int $id
     * @return Transaction
     */
    public function setId(int $id): Transaction
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return float
     */
    public function getTotal(): float
    {
        return $this->total;
    }

    /**
     * @param float $total
     * @return Transaction
     */
    public function setTotal(float $total): Transaction
    {
        $this->total = $total;
        return $this;
    }

    /**
     * @return string
     */
    public function getMethodPayment(): string
    {
        return $this->method_payment;
    }

    /**
     * @param string $method_payment
     * @return Transaction
     */
    public function setMethodPayment(string $method_payment): Transaction
    {
        $this->method_payment = $method_payment;
        return $this;
    }

    /**
     * @return string
     */
    public function getTransactionId(): string
    {
        return $this->transaction_id;
    }

    /**
     * @param string $transaction_id
     * @return Transaction
     */
    public function setTransactionId(string $transaction_id): Transaction
    {
        $this->transaction_id = $transaction_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

}
