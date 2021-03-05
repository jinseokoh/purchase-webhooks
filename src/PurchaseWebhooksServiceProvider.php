<?php

namespace JinseokOh\PurchaseWebhooks;

use Illuminate\Support\ServiceProvider;

class PurchaseWebhooksServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/purchase-webhooks.php' => config_path('purchase-webhooks.php'),
            ], 'config');
        }

        if (! class_exists('CreatePurchaseWebhooksTable')) {
            $timestamp = date('Y_m_d_His', time());
            $this->publishes([
                __DIR__.'/../database/migrations/create_purchase_webhooks_table.php.stub' => database_path("migrations/{$timestamp}_create_purchase_webhooks_table.php"),
            ], 'migrations');
        }

        $this->loadRoutesFrom(__DIR__.'/routes.php');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/purchase-webhooks.php', 'purchase-webhooks');
    }
}
