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
        $this->app->singleton(ChanelInterface::class,function($app) {
            $service = $app->request->route('service');
            switch($service) {
                case Chanel::ELITE->value:// 通路商:誠品實作
                    return $app->make(EliteService::class);
                case Chanel::MOMO->value: // 通路商:MOMO實作
                    return $app->make(MomoService::class);
                default: throw new \Exception('Chanel not found');
            }
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
