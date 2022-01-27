<?php

namespace App\Dominios\Transactions;

use App\Contracts\Transactions\TransactionRepositoryInterface;
use App\Models\TransactionModel;

class TransactionRepository implements TransactionRepositoryInterface {

    public function create(Transaction $transaction): Transaction
    {
            $transactionModel = new TransactionModel();
            $transactionModel->order_id = $transaction->getOrder()->getId();
            $transactionModel->total = $transaction->getOrder()->getTotal();
            $transactionModel->method_payment = $transaction->getMethodPayment();
            $transactionModel->status = $transaction->getStatus();
            $transactionModel->save();

            $transaction->setId($transactionModel->id);

        return $transaction;
    }

    public function get(int $transactionId): ?Transaction
    {
        // TODO: Implement get() method.
    }

    public function updateStatus(Transaction $transaction): Transaction
    {
        // TODO: Implement updateStatus() method.
    }
}
