<?php

namespace App\Providers;

use App\Http\Middleware\AuthMiddleware;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

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
        Route::aliasMiddleware('auth', AuthMiddleware::class);

        // If you have custom middleware for API routes, apply them here
        Route::prefix('api')->middleware('auth')
            ->group(base_path('routes/web.php'));  // Register API routes in web.php

        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(10)->by( $request->ip());
        });
    }
}
