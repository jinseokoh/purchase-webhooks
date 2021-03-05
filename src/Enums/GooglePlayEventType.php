<?php

namespace JinseokOh\PurchaseWebhooks\Enums;

use BenSampo\Enum\Enum;

class GooglePlayEventType extends Enum
{
    const JOBS = [
        1 => 'subscription_recovered', // subscription was recovered from account hold.
        2 => 'subscription_renewed', // - An active subscription was renewed.
        3 => 'subscription_canceled', // - A subscription was either voluntarily or involuntarily cancelled. For voluntary cancellation, sent when the user cancels.
        4 => 'subscription_purchased', // - A new subscription was purchased.
        5 => 'subscription_on_hold', // - A subscription has entered account hold (if enabled).
        6 => 'subscription_in_grace_period', // - A subscription has entered grace period (if enabled).
        7 => 'subscription_restarted', // - User has reactivated their subscription from Play > Account > Subscriptions (requires opt-in for subscription restoration)
        8 => 'subscription_price_change_confirmed', // - A subscription price change has successfully been confirmed by the user.
        9 => 'subscription_deferred', // - A subscription's recurrence time has been extended.
        10 => 'subscription_paused', // - A subscription has been paused.
        11 => 'subscription_pause_schedule_changed', // - A subscription pause schedule has been changed.
        12 => 'subscription_revoked', // - A subscription has been revoked from the user before the expiration time.
        13 => 'subscription_expired', // - A subscription has expired.
    ];
}
