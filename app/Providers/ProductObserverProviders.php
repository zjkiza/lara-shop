<?php

namespace App\Providers;

use App\Model\Product;
use App\Observers\ProductObserver;
use Illuminate\Support\ServiceProvider;

class ProductObserverProviders extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        Product::observe(ProductObserver::class);
    }
}
