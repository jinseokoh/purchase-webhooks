# Handle App Purchase Server-to-Server Webhooks

## Installation

You can install this package via composer

```bash
composer require jinseokoh/purchase-webhooks 
 ```

You must publish the config file with:

```bash
php artisan vendor:publish --provider="JinseokOh\PurchaseWebhooks\PurchaseWebhooksServiceProvider" --tag="config" 
 ```

This is the config that will be published.

```php
return [
    /*
     * Apple will send the shared secret with the request that should match
     * the one you use when validating receipts.
     * https://developer.apple.com/documentation/storekit/in-app_purchase/enabling_server-to-server_notifications?language=objc#overview
     */
    'shared_secret' => env('APPLE_SHARED_SECRET'),

    /*
     * All the events that should be handeled by your application.
     * Typically you should uncomment all jobs
     *
     * You can find a list of all notification types here:
     * https://developer.apple.com/documentation/storekit/in-app_purchase/enabling_server-to-server_notifications?language=objc#3162176
     */
    'jobs' => [
        // 'initial_buy' => \App\Jobs\AppstoreNotifications\HandleInitialBuy::class,
        // 'cancel' => \App\Jobs\AppstoreNotifications\HandleCancellation::class,
        // 'renewal' => \App\Jobs\AppstoreNotifications\HandleRenewal::class,
        // 'interactive_renewal' => \App\Jobs\AppstoreNotifications\HandleInteractiveRenewal::class,
        // 'did_change_renewal_pref' => \App\Jobs\AppstoreNotifications\HandleDidChangeRenewalPreferences::class,
        // 'did_change_renewal_status' => \App\Jobs\AppstoreNotifications\HandleDidChangeRenewalStatus::class,

        // 'subscription_recovered' => \App\Jobs\PlayStore\HandleRecovered::class,
        // 'subscription_renewed' => \App\Jobs\PlayStore\HandleRenewed::class,
        // 'subscription_canceled' =>  \App\Jobs\PlayStore\HandleCanceled::class,
        // 'subscription_purchased' => \App\Jobs\PlayStore\HandlePurchased::class,
        // 'subscription_on_hold' => \App\Jobs\PlayStore\HandleOnHold::class,
        // 'subscription_in_grace_period' => \App\Jobs\PlayStore\HandleInGracePeriod::class,
        // 'subscription_restarted' => \App\Jobs\PlayStore\HandleRestarted::class,
        // 'subscription_price_change_confirmed' => \App\Jobs\PlayStore\HandlePriceChangeConfirmed::class,
        // 'subscription_deferred' => \App\Jobs\PlayStore\HandleDeferred::class,
        // 'subscription_paused' => \App\Jobs\PlayStore\HandlePaused::class,
        // 'subscription_pause_schedule_changed' => \App\Jobs\PlayStore\HandlePauseScheduleChanged::class,
        // 'subscription_revoked' => \App\Jobs\PlayStore\HandleRevoked::class,
        // 'subscription_expired' => \App\Jobs\PlayStore\HandleExpired::class
    ],
];

```
The shared secret should match the one you send to the store to validate receipts

This package logs all the incoming requests to the database so these steps are also mandatory:

```bash
php artisan vendor:publish --provider="JinseokOh\PurchaseWebhooks\PurchaseWebhooksServiceProvider" --tag="migrations"
```

You should run migrate next to create the `webhooks` table:

```bash
php artisan migrate
```

This package registers the following POST routes

- /webhooks/apple/purchase
- /webhooks/google/purchase

## Usage

- will be presented shortly.

## Credits

This package is heavily based on [Daan Geurts](https://github.com/DaanGeurts) previous works, which seem to be deprecated somehow.
A big thanks to [Daan Geurts](https://github.com/DaanGeurts) for his efforts and time.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.