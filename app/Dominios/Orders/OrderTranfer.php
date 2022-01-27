<?php

namespace App\Dominios\Orders;

use App\Contracts\Suppliers\OrderRepositoryInterface;
use App\Dominios\Clients\ClientTranfer;
use App\Dominios\Products\ProductTranfer;
use App\Models\OrderModel;

class OrderTranfer
{
    /**
     * @var OrderModel
     */
    private $orderModel;

    /**
     * OrderTranfer constructor.
     * @param OrderModel $order
     */
    private function __construct(OrderModel $order)
    {
        $this->orderModel = $order;
    }

    /**
     * mapper OrderModel to entity of Order
     * @return Order
     */
    public function mapperToOrder() : Order
    {
        $items = [];
        $total = 0;
        foreach ($this->orderModel->items as $item){
            array_push(
                $items,
                (new OrderItem(
                    ProductTranfer::create($item->product)->mapperToProduct(),
                    $item->quantity,
                    $item->sale_price
                ))->setId($item->quantity)
            );
            $total +=  $item->quantity * $item->sale_price;
        }


        return (new Order(
            ClientTranfer::create($this->orderModel->client)->mapperToClient(),
            $items,
            $this->orderModel->status,
        ))->setId($this->orderModel->id)->setTotal($total);
    }

    /**
     * Creating a object Tranfer
     * @param $data
     * @return OrderTranfer
     */
    public static function create($data)
    {
        return new OrderTranfer($data);
    }

}
