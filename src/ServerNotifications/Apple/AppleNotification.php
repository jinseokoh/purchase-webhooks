<?php

namespace JinseokOh\PurchaseWebhooks\ServerNotifications\Apple;

use JinseokOh\PurchaseWebhooks\ServerNotifications\Apple\ReceiptResponse;
use Illuminate\Support\Carbon;

class AppleNotification
{
    const CANCEL = 'CANCEL';
    const DID_CHANGE_RENEWAL_PREF = 'DID_CHANGE_RENEWAL_PREF';
    const DID_CHANGE_RENEWAL_STATUS = 'DID_CHANGE_RENEWAL_STATUS';
    const DID_FAIL_TO_RENEW = 'DID_FAIL_TO_RENEW';
    const DID_RECOVER = 'DID_RECOVER';
    const DID_RENEW = 'DID_RENEW';
    const INITIAL_BUY = 'INITIAL_BUY';
    const INTERACTIVE_RENEWAL = 'INTERACTIVE_RENEWAL';
    const PRICE_INCREASE_CONSENT = 'PRICE_INCREASE_CONSENT';
    const REFUND = 'REFUND';

    /**
     * @var ReceiptResponse
     */
    protected $unifiedReceipt;

    /**
     * @var Carbon|null
     */
    protected $autoRenewStatusChangeDate;

    /**
     * @var string
     */
    protected $environment;

    /**
     * @var bool
     */
    protected $autoRenewStatus;

    /**
     * @var int
     */
    protected $bvrs;

    /**
     * @var string
     */
    protected $bid;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var string
     */
    protected $autoRenewProductId;

    /**
     * @var string
     */
    protected $notificationType;

    /**
     * @param array $attributes
     * @return static
     */
    public static function fromArray(array $attributes): self
    {
        $obj = new self();
        $obj->unifiedReceipt = new ReceiptResponse($attributes['unified_receipt']);
        $obj->autoRenewStatusChangeDate = isset($attributes['auto_renew_status_change_date_ms']) ? Carbon::createFromTimestampMs($attributes['auto_renew_status_change_date_ms']) : null;
        $obj->environment = $attributes['environment'] ?? null;
        $obj->autoRenewStatus = isset($attributes['auto_renew_status']) ? $attributes['auto_renew_status'] === "true" : false;
        $obj->bvrs = $attributes['bvrs'] ?? null;
        $obj->bid = $attributes['bid'] ?? null;
        $obj->password = $attributes['password'] ?? null;
        $obj->autoRenewProductId = $attributes['auto_renew_product_id'] ?? null;
        $obj->notificationType = $attributes['notification_type'] ?? null;

        return $obj;
    }

    /**
     * @return ReceiptResponse
     */
    public function getUnifiedReceipt(): ReceiptResponse
    {
        return $this->unifiedReceipt;
    }

    /**
     * @return Carbon|null
     */
    public function getAutoRenewStatusChangeDate(): ?Carbon
    {
        return $this->autoRenewStatusChangeDate;
    }

    /**
     * @return string
     */
    public function getEnvironment(): string
    {
        return $this->environment;
    }

    /**
     * @return bool
     */
    public function isAutoRenewStatus(): bool
    {
        return $this->autoRenewStatus;
    }

    /**
     * @return int
     */
    public function getBvrs(): int
    {
        return $this->bvrs;
    }

    /**
     * @return string
     */
    public function getBid(): string
    {
        return $this->bid;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getAutoRenewProductId(): string
    {
        return $this->autoRenewProductId;
    }

    /**
     * @return string
     */
    public function getNotificationType(): string
    {
        return $this->notificationType;
    }
}
