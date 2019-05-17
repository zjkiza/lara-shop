<?php

namespace App\Providers;

use App\Repository\CategoryRepository;
use App\Repository\DetailRepository;
use App\Repository\ManufacturerRepository;
use App\Repository\PictureRepository;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;
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

        $this->app->bind(
            'App\Repository\IPicture',
            'App\Repository\PictureRepository'
        );

        $this->app->bind(
            'App\Repository\IUser',
            'App\Repository\UserRepository'
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

        $this->app->singleton(PictureRepository::class, function () {

            return new PictureRepository();
        });

        $this->app->singleton(UserRepository::class, function () {

            return new UserRepository();
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
