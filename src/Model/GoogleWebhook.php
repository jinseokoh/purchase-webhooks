<?php

namespace JinseokOh\PurchaseWebhooks\Model;

use Illuminate\Database\Eloquent\Model;

class GoogleWebhook extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'purchase_webhooks';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'payload' => 'array',
    ];

    public static function storePayload(string $notificationType, array $notificationPayload)
    {
        return self::create([
            'platform' => 'google',
            'type' => $notificationType,
            'payload' => $notificationPayload,
        ]);
    }
}
