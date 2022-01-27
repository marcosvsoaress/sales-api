<?php

namespace App\Dominios\Orders;

use App\Contracts\Orders\OrderResponseApiInterface;
use App\Dominios\Clients\ClientResponseApi;
use App\Dominios\Common\ResponseApi;
use App\Dominios\Products\ProductResponseApi;

class OrderResponseApi extends ResponseApi implements OrderResponseApiInterface
{
    private $data = null;

    private function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Creates a response Formated to be sending to the order
     *
     * @return array
     */
    public function toResponse()
    {
        if (is_null($this->data) || empty($this->data)) {
            return self::responseJson('Order not found');
        }

        $data = [];
        if (is_array($this->data)) {
            $orders = [];
            foreach ($this->data as $order) {
                array_push($orders, $this->toArray($order));
            }
            $data['orders'] = $orders;
        } else {
            $data['order'] = $this->toArray($this->data);
        }
        return self::responseJson('', $data);
    }

    /**
     * format Object to Array
     *
     * @param Order $order
     * @return array
     */
    public function toArray(Order $order)
    {
        $items = [];
        /** @var $item OrderItem */
        foreach ($order->getItems() as $item){
            array_push($items, [
                'id' => $item->getId(),
                'quantity' => $item->getQuantity(),
                'sale_price' => $item->getSalePrice(),
                'product' => ProductResponseApi::create($item->getProduct())->toResponse(false),
            ]);
        }

        return [
            'status' => $order->getStatus(),
            'total' => $order->getTotal(),
            'client' => ClientResponseApi::create($order->getClient())->toResponse(false),
            'items' => $items
        ];
    }

    /**
     * Create a new orderResponse
     *
     * @param $data
     * @return OrderResponseApi
     */
    public static function create($data)
    {
        return new OrderResponseApi($data);
    }
}
