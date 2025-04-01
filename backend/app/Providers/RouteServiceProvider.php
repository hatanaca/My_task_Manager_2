<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define your route model bindings, pattern filters, etc.
     */
    public function boot()
{
    $this->routes(function () {
        Route::middleware('api')
            ->namespace($this->namespace)  // Adicione esta linha
            ->group(base_path('routes/api.php'));
    });
}
    /**
     * Configure the rate limiters for the application.
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }

    /**
     * Define the routes for the application.
     */
    public function map(): void
    {
        Log::debug('Mapping routes...');

        $this->mapApiRoutes();
    }

    /**
     * Define the "api" routes for the application.
     */
    protected function mapApiRoutes(): void
{
    Route::middleware('api')
        ->prefix('api')
        ->namespace('App\Http\Controllers')
        ->group(base_path('routes/api.php')); // Teste com o novo arquivo
}
}
