<?php

Route::post('/webhooks/apple/purchase', "\JinseokOh\PurchaseWebhooks\WebhooksController@apple")
  ->name('apple.server.webhook');
Route::post('/webhooks/google/purchase', "\JinseokOh\PurchaseWebhooks\WebhooksController@google")
    ->name('google.server.webhook');
