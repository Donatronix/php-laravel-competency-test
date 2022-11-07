<?php

namespace App\Providers;

use App\Services\BaseService;
use App\Services\Interfaces\BaseServiceInterface;
use App\Services\Interfaces\PaymentMethodServiceInterface;
use App\Services\Interfaces\PaymentOrderServiceInterface;
use App\Services\Interfaces\UserServiceInterface;
use App\Services\PaymentMethodService;
use App\Services\PaymentOrderService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AdapterServiceProvider extends ServiceProvider
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
    public function boot(): void
    {
        $this->app->bind(BaseServiceInterface::class, BaseService::class);
        $this->app->bind(PaymentMethodServiceInterface::class, PaymentMethodService::class);
        $this->app->bind(PaymentOrderServiceInterface::class, PaymentOrderService::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);

    }
}
