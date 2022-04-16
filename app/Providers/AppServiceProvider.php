<?php

namespace App\Providers;

use App\Repositories\Eloquent\ClassPackRepository;
use App\Repositories\Interfaces\ClassPackRepositoryInterface;
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
        $this->app->bind(ClassPackRepositoryInterface::class, ClassPackRepository::class);
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
