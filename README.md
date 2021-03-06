# Handle App Purchase Server-to-Server Webhooks with Laravel

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
<?php

return [
    // apple
    'appstore_sandbox' => (bool) env('APPLE_IAP_SANDBOX', true),
    'appstore_password' => env('APPLE_SHARED_SECRET'),

    // google
    'play_package_name' => env('GOOGLE_PLAY_PACKAGE_NAME', 'com.awesome.freaking'),

    /*
     * Uncomment the events that should be handeled by your application.
     *
     * as for the apple app store server notifications, refer the following docs
     * https://developer.apple.com/documentation/storekit/in-app_purchase/enabling_server-to-server_notifications
     * as for the google play store server notifications, refer the following docs
     * https://developer.android.com/google/play/billing/rtdn-reference
     */

    'jobs' => [
        // 'CANCEL' => \App\Jobs\Apple\HandleCancel::class,
        // 'DID_CHANGE_RENEWAL_PREF' => \App\Jobs\Apple\HandleDidChangeRenewalPref::class,
        // 'DID_CHANGE_RENEWAL_STATUS' => \App\Jobs\Apple\HandleDidChangeRenewalStatus::class,
        // 'DID_FAIL_TO_RENEW' => \App\Jobs\Apple\HandleDidFailToRenew::class,
        // 'DID_RECOVER' => \App\Jobs\Apple\HandleDidRecover::class,
        // 'DID_RENEW' => \App\Jobs\Apple\HandleDidRenew::class,
        // 'INITIAL_BUY' => \App\Jobs\Apple\HandleInitialBuy::class,
        // 'INTERACTIVE_RENEWAL' => \App\Jobs\Apple\HandleInteractiveRenewal::class,
        // 'PRICE_INCREASE_CONSENT' => \App\Jobs\Apple\HandlePriceIncreaseConsent::class,
        // 'REFUND' => \App\Jobs\Apple\HandleRefund::class,

        // 'ONE_TIME_PRODUCT_PURCHASED' => \App\Jobs\PlayStore\HandleOneTimeProductPurchased::class,
        // 'ONE_TIME_PRODUCT_CANCELED' => \App\Jobs\PlayStore\HandleOneTimeProductCanceled::class,
        // 'SUBSCRIPTION_RECOVERED' => \App\Jobs\PlayStore\HandleRecovered::class,
        // 'SUBSCRIPTION_RENEWED' => \App\Jobs\PlayStore\HandleRenewed::class,
        // 'SUBSCRIPTION_CANCELED' =>  \App\Jobs\PlayStore\HandleCanceled::class,
        // 'SUBSCRIPTION_PURCHASED' => \App\Jobs\PlayStore\HandlePurchased::class,
        // 'SUBSCRIPTION_ON_HOLD' => \App\Jobs\PlayStore\HandleOnHold::class,
        // 'SUBSCRIPTION_IN_GRACE_PERIOD' => \App\Jobs\PlayStore\HandleInGracePeriod::class,
        // 'SUBSCRIPTION_RESTARTED' => \App\Jobs\PlayStore\HandleRestarted::class,
        // 'SUBSCRIPTION_PRICE_CHANGE_CONFIRMED' => \App\Jobs\PlayStore\HandlePriceChangeConfirmed::class,
        // 'SUBSCRIPTION_DEFERRED' => \App\Jobs\PlayStore\HandleDeferred::class,
        // 'SUBSCRIPTION_PAUSED' => \App\Jobs\PlayStore\HandlePaused::class,
        // 'SUBSCRIPTION_PAUSE_SCHEDULE_CHANGED' => \App\Jobs\PlayStore\HandlePauseScheduleChanged::class,
        // 'SUBSCRIPTION_REVOKED' => \App\Jobs\PlayStore\HandleRevoked::class,
        // 'SUBSCRIPTION_EXPIRED' => \App\Jobs\PlayStore\HandleExpired::class
    ],
];


This package registers the following POST routes

- `/webhooks/apple/purchase`
- `/webhooks/google/purchase`

## Usage

- will be presented shortly.

## Credits

This package is heavily based on [app-vise/laravel-appstore-notifications](https://github.com/app-vise/laravel-appstore-notifications) and [imdhemy/laravel-in-app-purchases](https://github.com/imdhemy/laravel-in-app-purchases) A big thanks to the authors of their great packages.

## Backgrounds

At the time of writing API servers for new mobile application, I wanted to have a drop-in solution to take care of one time in-app purchases as opposed to subscriptions. All the packages I've found are more focused on subscription model, which isn't my use-case. So, I created this package.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
