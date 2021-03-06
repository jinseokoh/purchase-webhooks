# Handle App Purchase Server-to-Server Webhooks with Laravel

## Backgrounds

At the time of writing API servers for a new mobile application, I've found this [aporat/store-receipt-validator](https://github.com/aporat/store-receipt-validator) package very useful to handle in-app one time product purchase requests from Apple App Store and Google Play Store. But, there're occasions that anyone can ask refund their purchases directly to the stores without notifying us of the cancellation.

I know there exists Google Play Store API that we can make use of to retrieve voided purchases information. But, that's not so 2021. The both platforms allow us to register webhook URL address to post back all the store events including INITIAL PURCHASE and CANCELLATION. As long as you've the webhooks in place, you can get almost realtime server-to-server notifications if someone's got refunded. That means you can deprive the user of any privileges or coins within your app.

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
    'play_package_name' => env('GOOGLE_PLAY_PACKAGE_NAME', 'com.what.ever'),

    /*
     * Uncomment the events that should be handeled by your application.
     *
     * as for the apple app store server notifications, refer the following docs
     * https://developer.apple.com/documentation/storekit/in-app_purchase/enabling_server-to-server_notifications
     * as for the google play store server notifications, refer the following docs
     * https://developer.android.com/google/play/billing/rtdn-reference
     */

    'jobs' => [
        // 'CANCEL' => \App\Jobs\Apple\WebhookCancel::class,
        // 'DID_CHANGE_RENEWAL_PREF' => \App\Jobs\Apple\WebhookDidChangeRenewalPref::class,
        // 'DID_CHANGE_RENEWAL_STATUS' => \App\Jobs\Apple\WebhookDidChangeRenewalStatus::class,
        // 'DID_FAIL_TO_RENEW' => \App\Jobs\Apple\WebhookDidFailToRenew::class,
        // 'DID_RECOVER' => \App\Jobs\Apple\WebhookDidRecover::class,
        // 'DID_RENEW' => \App\Jobs\Apple\WebhookDidRenew::class,
        // 'INITIAL_BUY' => \App\Jobs\Apple\WebhookInitialBuy::class,
        // 'INTERACTIVE_RENEWAL' => \App\Jobs\Apple\WebhookInteractiveRenewal::class,
        // 'PRICE_INCREASE_CONSENT' => \App\Jobs\Apple\WebhookPriceIncreaseConsent::class,
        // 'REFUND' => \App\Jobs\Apple\WebhookRefund::class,

        // 'ONE_TIME_PRODUCT_PURCHASED' => \App\Jobs\Google\WebhookOneTimeProductPurchased::class,
        // 'ONE_TIME_PRODUCT_CANCELED' => \App\Jobs\Google\WebhookOneTimeProductCanceled::class,
        // 'SUBSCRIPTION_RECOVERED' => \App\Jobs\Google\WebhookRecovered::class,
        // 'SUBSCRIPTION_RENEWED' => \App\Jobs\Google\WebhookRenewed::class,
        // 'SUBSCRIPTION_CANCELED' =>  \App\Jobs\Google\WebhookCanceled::class,
        // 'SUBSCRIPTION_PURCHASED' => \App\Jobs\Google\WebhookPurchased::class,
        // 'SUBSCRIPTION_ON_HOLD' => \App\Jobs\Google\WebhookOnHold::class,
        // 'SUBSCRIPTION_IN_GRACE_PERIOD' => \App\Jobs\Google\WebhookInGracePeriod::class,
        // 'SUBSCRIPTION_RESTARTED' => \App\Jobs\Google\WebhookRestarted::class,
        // 'SUBSCRIPTION_PRICE_CHANGE_CONFIRMED' => \App\Jobs\Google\WebhookPriceChangeConfirmed::class,
        // 'SUBSCRIPTION_DEFERRED' => \App\Jobs\Google\WebhookDeferred::class,
        // 'SUBSCRIPTION_PAUSED' => \App\Jobs\Google\WebhookPaused::class,
        // 'SUBSCRIPTION_PAUSE_SCHEDULE_CHANGED' => \App\Jobs\Google\WebhookPauseScheduleChanged::class,
        // 'SUBSCRIPTION_REVOKED' => \App\Jobs\Google\WebhookRevoked::class,
        // 'SUBSCRIPTION_EXPIRED' => \App\Jobs\Google\WebhookExpired::class
    ],
];
```

This package registers the following POST routes

- `/webhooks/apple/purchase`
- `/webhooks/google/purchase`

## Usage

Uncomment any events of your interest in `config/purchase.php`, and let each Job class handle the payload from Apple/Googe server.

### Handle Apple Server Notifications

- the following sample is provided to help you understand how you can prepare your own Laravel Job for Apple Server Notifications.

```php
<?php

namespace App\Jobs\Apple;

use App\Events\VoidProductPurchase;
use App\Handlers\OrderHandler;
use JinseokOh\PurchaseWebhooks\ServerNotifications\Apple\ReceiptResponse;

class WebhookRefund
{
    private ReceiptResponse $response;
    private OrderHandler $orderHandler;

    public function __construct(
        ReceiptResponse $response,
        OrderHandler $orderHandler
    ) {
        $this->response = $response;
        $this->orderHandler = $orderHandler;
    }

    public function handle()
    {
        foreach ($this->response->getLatestReceiptInfo() as $receiptInfo) {
            $transactionId = $receiptInfo->getTransactionId();
            $order = $this->orderHandler->findByPurchaseToken($transactionId);
            if ($order) {
                event(new VoidProductPurchase($order));
            }
        }
    }
}
```

- the following sample is provided to help you understand how you can prepare your own Laravel Job for Google Server Notifications.

```php
<?php

namespace App\Jobs\Google;

use App\Events\VoidProductPurchase;
use App\Handlers\OrderHandler;

class WebhookOneTimeProductCanceled
{
    private string $purchaseToken;
    private string $sku;
    private OrderHandler $orderHandler;

    public function __construct(
        string $purchaseToken,
        string $sku,
        OrderHandler $orderHandler
    ) {
        $this->purchaseToken = $purchaseToken;
        $this->sku = $sku;
        $this->orderHandler = $orderHandler;
    }

    public function handle()
    {
        $order = $this->orderHandler
            ->findByPurchaseToken($this->purchaseToken);
        if ($order) {
            event(new VoidProductPurchase($order));
        }
    }
}
```

## Credits

This package is heavily based on [app-vise/laravel-appstore-notifications](https://github.com/app-vise/laravel-appstore-notifications) and [imdhemy/laravel-in-app-purchases](https://github.com/imdhemy/laravel-in-app-purchases) A big thanks to the authors of their great packages.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
