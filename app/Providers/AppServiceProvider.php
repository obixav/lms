<?php

namespace App\Providers;

use App\Services\CartService;
use Illuminate\Foundation\Application;
use Illuminate\Pagination\Paginator;
use Illuminate\Session\SessionManager;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //

//        $this->app->bind('cart',function(Application $app) {
//            $session = $app->make(SessionManager::class);
//            return new CartService($session);
//        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::defaultView('vendor.pagination.custom');
//        Paginator::useBootstrapFour();
//        Paginator::useBootstrap();
    }
}
