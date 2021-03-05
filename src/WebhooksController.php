<?php

namespace JinseokOh\PurchaseWebhooks;

use JinseokOh\PurchaseWebhooks\Enums\AppleAppstoreEventType;
use JinseokOh\PurchaseWebhooks\Enums\GooglePlayEventType;
use JinseokOh\PurchaseWebhooks\Exceptions\WebhookFailed;
use JinseokOh\PurchaseWebhooks\Model\ApplePurchasePayload;
use JinseokOh\PurchaseWebhooks\Model\AppleWebhook;
use JinseokOh\PurchaseWebhooks\Model\GoogleWebhook;
use Illuminate\Http\Request;

class WebhooksController
{
    public function apple(Request $request)
    {
        \Log::info('[DEBUG]' . print_r($request->input(), 1));

        if ($request->input('password') !== config('purchase-webhooks.shared_secret')) {
            throw WebhookFailed::invalidRequest();
        }

        $notification = $request->input('notification_type');
        $jobConfigKey = AppleAppstoreEventType::{$notification}();
        $jobClass = config("purchase-webhooks.jobs.{$jobConfigKey}", null);

        AppleWebhook::storePayload($jobConfigKey, $request->input());

        if (is_null($jobClass)) {
            throw WebhookFailed::jobClassDoesNotExist($jobConfigKey);
        }

        $payload = ApplePurchasePayload::createFromRequest($request);
        $job = new $jobClass($payload);

        dispatch($job);

        return response()->json();
    }


    public function google(Request $request)
    {
        \Log::info('[DEBUG]' . print_r($request->input(), 1));

        $notification = $request->input('subscriptionNotification.notificationType');
        $jobConfigKey = GooglePlayEventType::JOBS[$notification];
        $jobClass = config("purchase-webhooks.jobs.{$jobConfigKey}", null);

        GoogleWebhook::storePayload($jobConfigKey, $request->input());

        if (is_null($jobClass)) {
            throw WebhookFailed::jobClassDoesNotExist($jobConfigKey);
        }

        $job = new $jobClass($request->input());

        dispatch($job);

        return response()->json();
    }
}
