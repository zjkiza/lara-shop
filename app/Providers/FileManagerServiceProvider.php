<?php

namespace App\Providers;

use App\Service\FileManager;
use Illuminate\Support\ServiceProvider;

final class FileManagerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(FileManager::class, static function () {

            return new FileManager(config('filesystems.disks.myDisks.storage'));
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
    }
}
