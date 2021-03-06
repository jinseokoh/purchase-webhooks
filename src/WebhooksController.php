<?php

namespace JinseokOh\PurchaseWebhooks;

use Illuminate\Support\Facades\Log;
use JinseokOh\PurchaseWebhooks\Enums\AppleAppstoreEventType;

use JinseokOh\PurchaseWebhooks\Exceptions\WebhookFailed;
use JinseokOh\PurchaseWebhooks\ServerNotifications\Apple\AppleNotification;
use JinseokOh\PurchaseWebhooks\ServerNotifications\Google\GoogleNotification;
use JinseokOh\PurchaseWebhooks\ServerNotifications\Google\OneTimePurchaseNotification;
use JinseokOh\PurchaseWebhooks\ServerNotifications\Google\SubscriptionNotification;
use JinseokOh\PurchaseWebhooks\Model\ApplePurchasePayload;
use JinseokOh\PurchaseWebhooks\Requests\ApplePurchaseWebhookRequest;
use JinseokOh\PurchaseWebhooks\Requests\GooglePurchaseWebhookRequest;

class WebhooksController
{
    public function apple(ApplePurchaseWebhookRequest $request)
    {
        Log::info('[DEBUG]' . print_r($request->input(), 1));

        $attributes = $request->all();
        $appleNotification = AppleNotification::fromArray($attributes);
        $type = $appleNotification->getNotificationType();
        /** ReceiptResponse $receipt */
        $receipt = $appleNotification->getUnifiedReceipt();
        $password = $appleNotification->getPassword();

        if ($password !== config('purchase.appstore_password')) {
            throw WebhookFailed::invalidRequest();
        }

        $jobClass = config("purchase.jobs.{$type}");

        Log::info('[DEBUG]' . print_r($receipt, 1));

        if (! is_null($jobClass)) {
            $job = new $jobClass($receipt);

            dispatch($job);
        }

        return response()->json();
    }

    public function google(GooglePurchaseWebhookRequest $request)
    {
        $data = $request->getData();
        if (! $this->isParsable($data)) {
            Log::info(sprintf("[DEBUG] Google Play malformed RTDN: %s", json_encode($request->all())));

            return response()->noContent();
        }

        $googleNotification = GoogleNotification::parse($data);

        if ($googleNotification->isTestNotification()) {
            $notification = $googleNotification->getTestNotification();
            Log::info(sprintf("Google Play Test Notification, version: %s", $notification->getVersion()));
        }

        if ($googleNotification->isSubscriptionNotification()) {
            $notification = $googleNotification->getSubscriptionNotification();
            Log::info(sprintf("Google Play Subscription Notification, type: %s", $notification->getNotificationType()));

            $types = (new ReflectionClass(SubscriptionNotification::class))->getConstants();
            $type = array_search($notification->getNotificationType(), $types);
            $jobClass = config("purchase.jobs.{$type}");

            if (! is_null($jobClass)) {
                $job = new $jobClass(
                    $notification->getPurchaseToken(),
                    $notification->getSubscriptionId()
                );

                dispatch($job);
            }
        }

        if ($googleNotification->isOneTimeProductionNotification()) {
            $notification = $googleNotification->getOneTimeProductNotification();
            Log::info(sprintf("Google Play One Time Production Notification, type: %s", $notification->getNotificationType()));

            $types = (new ReflectionClass(OneTimePurchaseNotification::class))->getConstants();
            $type = array_search($notification->getNotificationType(), $types);
            $jobClass = config("purchase.jobs.{$type}");

            if (! is_null($jobClass)) {
                $job = new $jobClass(
                    $notification->getPurchaseToken(),
                    $notification->getSku()
                );

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
