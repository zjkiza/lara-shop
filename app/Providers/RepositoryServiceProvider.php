<?php

namespace App\Providers;

use App\Cache\ProductCache;
use App\Model\Picture;
use App\Model\Product;
use App\Repository\CategoryRepository;
use App\Repository\DetailRepository;
use App\Repository\ICategory;
use App\Repository\IDetail;
use App\Repository\IManufacturer;
use App\Repository\IPicture;
use App\Repository\IProduct;
use App\Repository\IUser;
use App\Repository\ManufacturerRepository;
use App\Repository\PictureRepository;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use Illuminate\Support\ServiceProvider;

final class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IProduct::class, static function () {
            return new ProductCache(
                new ProductRepository((new Product)->newQuery())
            );
        });

        $this->app->bind(
            IManufacturer::class, ManufacturerRepository::class
        );
        $this->app->bind(
            ICategory::class, CategoryRepository::class
        );
        $this->app->bind(
            IDetail::class, DetailRepository::class
        );
        $this->app->bind(
            IPicture::class,  static function () {
                return new PictureRepository((new Picture())->newQuery());
            }
        );

        $this->app->bind(
            IUser::class, UserRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
    }
}
