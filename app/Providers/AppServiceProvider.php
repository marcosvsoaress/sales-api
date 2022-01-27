<?php

namespace App\Providers;

use App\Contracts\Products\ProductServiceInterface;
use App\Contracts\Transactions\GatewayPaymentInterface;
use App\Contracts\Transactions\TransactionServiceInterface;
use App\Dominios\Products\ProductService;
use App\Dominios\Transactions\FooBarGatewayPayment;
use App\Dominios\Transactions\TransactionService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ProductServiceInterface::class, ProductService::class);
        $this->app->bind(TransactionServiceInterface::class, TransactionService::class);
        $this->app->bind(GatewayPaymentInterface::class, FooBarGatewayPayment::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
