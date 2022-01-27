<?php

namespace App\Dominios\Orders;

use App\Contracts\Orders\OrderRepositoryInterface;
use App\Models\OrderItemsModel;
use App\Models\OrderModel;
use Illuminate\Support\Facades\DB;

class OrderRepository implements OrderRepositoryInterface
{

    /**
     * Create a new Order
     *
     * @param Order $order
     * @return Order
     */
    public function create(Order $order): Order
    {
        DB::transaction(function () use (&$order){
            $orderModel = new OrderModel();
            $orderModel->client_id = $order->getClient()->getId();
            $orderModel->status = $order->getStatus();
            $orderModel->save();

            $order->setId($orderModel->id);

            /* @var $item OrderItem */
            foreach ($order->getItems() as &$item) {
                $itemModel = new OrderItemsModel();
                $itemModel->order_id = $order->getId();
                $itemModel->product_id = $item->getProduct()->getId();
                $itemModel->quantity = $item->getQuantity();
                $itemModel->sale_price = $item->getSalePrice();
                $itemModel->save();

                $item->setId($itemModel->id);
                $order->setTotal($order->getTotal() + ($item->getSalePrice() * $item->getQuantity()));
            }
        });

        return $order;
    }

    /**
     * Get one Order by ID
     *
     * @param int $order_id
     * @return Order|null
     */
    public function get(int $order_id): ?Order
    {
        $orderModel = OrderModel::where('id', $order_id)->with(['items.product', 'client'])->first();
        return is_null($orderModel) ? $orderModel : OrderTranfer::create($orderModel)->mapperToOrder();

    }

    /**
     * @param Order $order
     * @return Order
     */
    public function updateStatus(Order $order): Order
    {
        $orderModel = OrderModel::find($order->getId());
        $orderModel->status = $order->getStatus();
        $orderModel->save();
        return $order;
    }
}
