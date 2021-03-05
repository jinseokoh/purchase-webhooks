<?php

namespace JinseokOh\PurchaseWebhooks;

use Illuminate\Support\Facades\Log;
use JinseokOh\PurchaseWebhooks\Enums\AppleAppstoreEventType;

use JinseokOh\PurchaseWebhooks\Exceptions\WebhookFailed;
use JinseokOh\PurchaseWebhooks\GoogleNotifications\GoogleNotification;
use JinseokOh\PurchaseWebhooks\GoogleNotifications\OneTimePurchaseNotification;
use JinseokOh\PurchaseWebhooks\Model\ApplePurchasePayload;
use JinseokOh\PurchaseWebhooks\Model\AppleWebhook;
use JinseokOh\PurchaseWebhooks\Model\GoogleWebhook;
use JinseokOh\PurchaseWebhooks\Requests\ApplePurchaseWebhookRequest;
use JinseokOh\PurchaseWebhooks\Requests\GooglePurchaseWebhookRequest;

class WebhooksController
{
    public function apple(ApplePurchaseWebhookRequest $request)
    {
        Log::info('[DEBUG]' . print_r($request->input(), 1));

        if ($request->input('password') !== config('purchase.appstore_password')) {
            throw WebhookFailed::invalidRequest();
        }

        $notification = $request->input('notification_type');
        $jobConfigKey = AppleAppstoreEventType::{$notification}();
        $jobClass = config("purchase.jobs.{$jobConfigKey}", null);

        AppleWebhook::storePayload($jobConfigKey, $request->input());

        if (is_null($jobClass)) {
            throw WebhookFailed::jobClassDoesNotExist($jobConfigKey);
        }

        $payload = ApplePurchasePayload::createFromRequest($request);
        $job = new $jobClass($payload);

        dispatch($job);

        return response()->json();
    }


    public function google(GooglePurchaseWebhookRequest $request)
    {
        Log::info('[DEBUG]' . print_r($request->input(), 1));

        $data = $request->getData();
        if (! $this->isParsable($data)) {
            Log::info(sprintf("[DEBUG] Google Play malformed RTDN: %s", json_encode($request->all())));

            return;
        }

        $googleNotification = GoogleNotification::parse($data);

        if ($googleNotification->isTestNotification()) {
            $version = $googleNotification
                ->getTestNotification()
                ->getVersion();

            Log::info(sprintf("Google Play Test Notification, version: %s", $version));
        }

        if ($googleNotification->isSubscriptionNotification()) {
            $notificationType = $googleNotification
                ->getSubscriptionNotification()
                ->getNotificationType();

            Log::info(sprintf("Google Play Subscription Notification, type: %s", $notificationType));
        }

        if ($googleNotification->isOneTimeProductionNotification()) {
            $notificationType = $googleNotification
                ->getOneTimeProductNotification()
                ->getNotificationType();

            Log::info(sprintf("Google Play One Time Production Notification, type: %s", $notificationType));

            $types = (new ReflectionClass(OneTimePurchaseNotification::class))
                ->getConstants();
            $type = array_search($notificationType, $types);

            $jobClass = config("purchase.jobs.{$type}", null);

            if (! is_null($jobClass)) {
                $job = new $jobClass($request->input());

                dispatch($job);
            }
        }

        return response()->json();
    }

    /**
     * @param string $data
     * @return bool
     */
    protected function isParsable(string $data): bool
    {
        $decodedData = json_decode(base64_decode($data), true);

        return ! is_null($decodedData);
    }
}
