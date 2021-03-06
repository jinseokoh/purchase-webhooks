# Handle App Purchase Server-to-Server Webhooks with Laravel

## Backgrounds

At the time of writing API servers for a new mobile application, I've found this [aporat/store-receipt-validator](https://github.com/aporat/store-receipt-validator) package very useful to handle in-app one time product purchase requests from Apple App Store and Google Play Store. But, there're occasions that anyone can ask refund their purchases directly to the store without notifying us of the cancellation.

I know there's an Google Play Store API that we can make use of to retrieve voided purchases information. But, that's not so 2021. The both platforms allow us to register webhook URL address to post back all the store events including INITIAL PURCHASE and CANCELLATION. As long as you've the webhooks in place, you can get almost realtime server-to-server notifications if someone's got refunded. That means you can deprive the user of any privileges or coins within your app.

This package handles the server to server notifications.

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
```

This package registers the following POST routes

- `/webhooks/apple/purchase`
- `/webhooks/google/purchase`

## Usage

- will be presented shortly.

## Credits

This package is heavily based on [app-vise/laravel-appstore-notifications](https://github.com/app-vise/laravel-appstore-notifications) and [imdhemy/laravel-in-app-purchases](https://github.com/imdhemy/laravel-in-app-purchases) A big thanks to the authors of their great packages.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
