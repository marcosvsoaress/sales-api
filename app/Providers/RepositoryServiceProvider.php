<?php

namespace App\Providers;

use App\Contracts\Clients\ClientRepositoryInterface;
use App\Contracts\Orders\OrderRepositoryInterface;
use App\Contracts\Transactions\TransactionRepositoryInterface;
use App\Dominios\Clients\ClientRepository;
use App\Contracts\Products\ProductRepositoryInterface;
use App\Dominios\Orders\OrderRepository;
use App\Dominios\Products\ProductRepository;
use App\Contracts\Suppliers\SupplierRepositoryInterface;
use App\Dominios\Suppliers\SupplierRepository;
use App\Dominios\Transactions\TransactionRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ClientRepositoryInterface::class, ClientRepository::class);
        $this->app->bind(SupplierRepositoryInterface::class, SupplierRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->bind(TransactionRepositoryInterface::class, TransactionRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
