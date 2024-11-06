<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interface\ChanelInterface;
use App\Services\EliteService;
use App\Services\MomoService;
use App\Enum\Chanel;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        switch(app()->request->route('service')) {
            case Chanel::ELITE:
                $this->app->singleton(ChanelInterface::class, EliteService::class);
                break;
            case Chanel::MOMO:
                $this->app->singleton(ChanelInterface::class, MomoService::class);
                break;
        }
        // $this->app->singleton(ChanelInterface::class, MomoService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
