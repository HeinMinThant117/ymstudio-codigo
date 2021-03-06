<?php

namespace App\Providers;

use App\Repositories\Eloquent\ClassPackRepository;
use App\Repositories\Eloquent\OrderRepository;
use App\Repositories\Eloquent\PromocodeRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Interfaces\ClassPackRepositoryInterface;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\Interfaces\PromocodeRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
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
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->bind(PromocodeRepositoryInterface::class, PromocodeRepository::class);
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
