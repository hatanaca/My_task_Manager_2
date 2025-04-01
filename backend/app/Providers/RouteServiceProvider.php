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
    // Adicione esta linha (nome completo do namespace dos controladores)
    protected $namespace = 'App\Http\Controllers';

    public function boot(): void
    {
        Route::middleware('api')
            ->prefix('api')
            ->namespace($this->namespace) // Agora esta linha funciona
            ->group(base_path('routes/api.php'));

        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }
}
