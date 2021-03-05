<?php

return [
    /*
     * Apple will send the shared secret with the request that should match
     * the one you use when validating receipts.
     * https://developer.apple.com/documentation/storekit/in-app_purchase/enabling_server-to-server_notifications?language=objc#overview
     */

    // apple
    'appstore_sandbox' => (bool) env('APPLE_IAP_SANDBOX', true),
    'appstore_password' => env('APPLE_SHARED_SECRET'),
    // google
    'play_package_name' => env('GOOGLE_PLAY_PACKAGE_NAME'),

    /*
     * All the events that should be handeled by your application.
     * Typically you should uncomment all jobs
     *
     * You can find a list of all notification types here:
     * https://developer.apple.com/documentation/storekit/in-app_purchase/enabling_server-to-server_notifications?language=objc#3162176
     */

    'jobs' => [
        // 'initial_buy' => \\App\\Jobs\\AppstoreNotifications\\HandleInitialBuy::class,
        // 'cancel' => \\App\\Jobs\\AppstoreNotifications\\HandleCancellation::class,
        // 'renewal' => \\App\\Jobs\\AppstoreNotifications\\HandleRenewal::class,
        // 'interactive_renewal' => \\App\\Jobs\\AppstoreNotifications\\HandleInteractiveRenewal::class,
        // 'did_change_renewal_pref' => \\App\\Jobs\\AppstoreNotifications\\HandleDidChangeRenewalPreferences::class,
        // 'did_change_renewal_status' => \\App\\Jobs\\AppstoreNotifications\\HandleDidChangeRenewalStatus::class,

        // 'ONE_TIME_PRODUCT_PURCHASED' => \\App\\Jobs\\PlayStore\\HandleOneTimeProductPurchased::class,
        // 'ONE_TIME_PRODUCT_CANCELED' => \\App\\Jobs\\PlayStore\\HandleOneTimeProductCanceled::class,
        // 'SUBSCRIPTION_RECOVERED' => \\App\\Jobs\\PlayStore\\HandleRecovered::class,
        // 'SUBSCRIPTION_RENEWED' => \\App\\Jobs\\PlayStore\\HandleRenewed::class,
        // 'SUBSCRIPTION_CANCELED' =>  \\App\\Jobs\\PlayStore\\HandleCanceled::class,
        // 'SUBSCRIPTION_PURCHASED' => \\App\\Jobs\\PlayStore\\HandlePurchased::class,
        // 'SUBSCRIPTION_ON_HOLD' => \\App\\Jobs\\PlayStore\\HandleOnHold::class,
        // 'SUBSCRIPTION_IN_GRACE_PERIOD' => \\App\\Jobs\\PlayStore\\HandleInGracePeriod::class,
        // 'SUBSCRIPTION_RESTARTED' => \\App\\Jobs\\PlayStore\\HandleRestarted::class,
        // 'SUBSCRIPTION_PRICE_CHANGE_CONFIRMED' => \\App\\Jobs\\PlayStore\\HandlePriceChangeConfirmed::class,
        // 'SUBSCRIPTION_DEFERRED' => \\App\\Jobs\\PlayStore\\HandleDeferred::class,
        // 'SUBSCRIPTION_PAUSED' => \\App\\Jobs\\PlayStore\\HandlePaused::class,
        // 'SUBSCRIPTION_PAUSE_SCHEDULE_CHANGED' => \\App\\Jobs\\PlayStore\\HandlePauseScheduleChanged::class,
        // 'SUBSCRIPTION_REVOKED' => \\App\\Jobs\\PlayStore\\HandleRevoked::class,
        // 'SUBSCRIPTION_EXPIRED' => \\App\\Jobs\\PlayStore\\HandleExpired::class
    ],
];
