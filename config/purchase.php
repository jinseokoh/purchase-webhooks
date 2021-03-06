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
