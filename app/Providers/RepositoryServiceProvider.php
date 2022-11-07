<?php

namespace App\Providers;

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
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\App\Repositories\Interfaces\PaymentMethodRepository::class, \App\Repositories\PaymentMethodRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\UserRepository::class, \App\Repositories\UserRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\TransactionRepository::class, \App\Repositories\TransactionRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\Interfaces\PaymentOrderRepository::class, \App\Repositories\PaymentOrderRepositoryEloquent::class);
        //:end-bindings:
    }
}
