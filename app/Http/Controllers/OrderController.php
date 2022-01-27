<?php

namespace App\Http\Controllers;


use App\Contracts\Clients\ClientRepositoryInterface;
use App\Contracts\Orders\OrderRepositoryInterface;
use App\Contracts\Products\ProductRepositoryInterface;
use App\Contracts\Products\ProductServiceInterface;
use App\Dominios\Orders\Order;
use App\Dominios\Orders\OrderItem;
use App\Dominios\Orders\OrderResponseApi;
use App\Dominios\Products\Product;
use App\Dominios\Products\ProductResponseApi;
use App\Dominios\Products\ProductService;
use App\Dominios\Transactions\TransactionMethodPaymentEnum;
use App\Events\ProcessOrder;
use App\Http\Requests\Orders\StoreOrderRequest;
use \App\Dominios\Orders\OrderStatusEnum;
use App\Http\Requests\Orders\UpdateOrderRequest;
use App\Http\Requests\Products\UpdateProductRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    /**
     * @var OrderRepository
     */
    private $orderRepository;

    /**
     * @var ClientRepository
     */
    private $clientRepository;

    /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * @var ProductService
     */
    private $productService;

    /**
     * Create a new controller instance.
     *
     * @param OrderRepositoryInterface $orderRepository
     * @param ClientRepositoryInterface $clientRepository
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(OrderRepositoryInterface $orderRepository, ClientRepositoryInterface $clientRepository, ProductRepositoryInterface $productRepository, ProductServiceInterface $productService)
    {
        $this->orderRepository = $orderRepository;
        $this->clientRepository = $clientRepository;
        $this->productRepository = $productRepository;
        $this->productService = $productService;
    }

    /**
     * Get one Order
     *
     * @param $idClient
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($orderId)
    {
        $order = $this->orderRepository->get($orderId);
        return response()->json(OrderResponseApi::create($order)->toResponse(), 200);
    }

    public function store(StoreOrderRequest $request)
    {
        $client = $this->clientRepository->get($request->client_id);

        if (!$client) {
            $message = 'It was not possible create Order data';
            return response()->json(OrderResponseApi::errorResponseJson($message), 500);
        }

        $orderItens = [];
        foreach ($request->products as $p){
            $product = $this->productRepository->get($p['id']);
            if (
                !$product ||
                !isset($p['quantity']) ||
                !$this->productService->hasStock($product, $p['quantity'])
            ) {
                $message = 'It was not possible create Order data';
                return response()->json(OrderResponseApi::errorResponseJson($message), 500);
            }
            array_push($orderItens, new OrderItem($product, $p['quantity'], $product->getPrice()));
        }

        $order = new Order($client, $orderItens, OrderStatusEnum::AWAITING_PAYMENT);
        $order->setMethodPayment(TransactionMethodPaymentEnum::CARD);

        try {
            $order = $this->orderRepository->create($order);
            ProcessOrder::dispatch($order);
        } catch (\Exception $e) {
            Log::error($e->getMessage(), $e->getTrace());
            $message = 'It was not possible create client data';
            return response()->json(OrderResponseApi::errorResponseJson($message), 500);
        }

        return response()->json(OrderResponseApi::create($order)->toResponse(), 201);
    }

    /**
     * Update a Status Order existing
     *
     * @param UpdateOrderRequest $request
     * @param $orderId
     * @return JsonResponse
     */
    public function update(UpdateOrderRequest $request, $orderId): JsonResponse
    {
        /**
         * @var Order
         */
        $order = $this->orderRepository->get($orderId);
        $order->setStatus($request->status);

        try {
            $order = $this->orderRepository->updateStatus($order);
        } catch (\Exception $e) {
            Log::error($e->getMessage(), $e->getTrace());
            $message = 'It was not possible update order data';
            return response()->json(OrderResponseApi::errorResponseJson($message), 500);
        }

        return response()->json(OrderResponseApi::create($order)->toResponse(), 200);
    }

}
