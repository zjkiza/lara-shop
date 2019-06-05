<?php

namespace App\Providers;

use App\Model\Product;
use App\Observers\ProductObserver;
use Illuminate\Support\ServiceProvider;

final class ProductObserverProviders extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Product::observe(ProductObserver::class);
    }
}
