<?php

namespace App\Contracts\Transactions;

use App\Dominios\Transactions\Transaction;

interface TransactionRepositoryInterface
{
    /**
     * @param Transaction $transaction
     * @return bool
     */
    public function create(Transaction $transaction) : Transaction;

    /**
     * @param int $transactionId
     * @return Transaction
     */
    public function get(int $transactionId) : ?Transaction;

    /**
     * @param Transaction $transaction
     * @return bool
     */
    public function updateStatus(Transaction $transaction) : Transaction;
}
