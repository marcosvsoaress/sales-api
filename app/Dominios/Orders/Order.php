<?php

namespace App\Dominios\Orders;

use App\Dominios\Clients\Client;

class Order
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var Client
     */
    private $client;

    /**
     * @var array
     */
    private $items;

    /**
     * @var string
     */
    private $status;

    /**
     * @var float
     */
    private $total = 0;

    /**
     * @var string
     */
    private $method_payment;

    /**
     * Order constructor.
     * @param Client $client
     * @param string $status
     */
    public function __construct(Client $client, array $items, string $status)
    {
        $this->client = $client;
        $this->status = $status;
        $this->items = $items;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Order
     */
    public function setId(int $id): Order
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * @param Client $client
     * @return Order
     */
    public function setClient(Client $client): Order
    {
        $this->client = $client;
        return $this;
    }

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param OrderItem $item
     */
    public function setItem(OrderItem $item): Order
    {
        array_push($this->items, $item);
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
     * @return Order
     */
    public function setStatus(string $status): Order
    {
        $this->status = $status;
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
     */
    public function setTotal(float $total): Order
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
     */
    public function setMethodPayment(string $method_payment): Order
    {
        $this->method_payment = $method_payment;
        return $this;
    }

}
