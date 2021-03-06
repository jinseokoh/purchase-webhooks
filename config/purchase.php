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
     *
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
