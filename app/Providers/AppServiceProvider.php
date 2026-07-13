<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\order;
use App\Models\cart;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        View::composer('*', function ($view) {

            $sessionId = session()->getId();

            $cart = cart::with('cartItems')->where('session_id', $sessionId)->first();

            $cartCount = $cart ? $cart->cartItems->sum('quantity') : 0;

            $view->with('cartCount', $cartCount);
        });

        View::composer('admin.*', function ($view) {
            $processingOrdersCount = order::where('status', 'paid')
                ->where('delivery_status', 'processing')
                ->count();

            $view->with('processingOrdersCount', $processingOrdersCount);
        });

    }
}
