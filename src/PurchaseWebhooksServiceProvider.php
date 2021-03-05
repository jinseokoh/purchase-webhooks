<?php

namespace JinseokOh\PurchaseWebhooks;

use Illuminate\Support\ServiceProvider;

class PurchaseWebhooksServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/purchase.php' => config_path('purchase.php'),
            ], 'config');
        }

        $this->loadRoutesFrom(__DIR__.'/routes.php');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/purchase.php', 'purchase');
    }
}
