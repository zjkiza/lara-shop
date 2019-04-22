<?php

namespace App\Providers;

use App\Repository\CategoryRepository;
use App\Repository\DetailRepository;
use App\Repository\ManufacturerRepository;
use App\Repository\ProductRepository;
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
        $this->app->bind(
            'App\Repository\IProduct',
            'App\Repository\ProductRepository'
        );

        $this->app->bind(
            'App\Repository\IManufacturer',
            'App\Repository\ManufacturerRepository'
        );

        $this->app->bind(
            'App\Repository\ICategory',
            'App\Repository\CategoryRepository'
        );

        $this->app->bind(
            'App\Repository\IDetail',
            'App\Repository\DetailRepository'
        );


        $this->app->singleton(ProductRepository::class, function () {

            return new ProductRepository();
        });

        $this->app->singleton(CategoryRepository::class, function () {

            return new CategoryRepository();
        });
        $this->app->singleton(ManufacturerRepository::class, function () {

            return new ManufacturerRepository();
        });
        $this->app->singleton(DetailRepository::class, function () {

            return new DetailRepository();
        });

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
