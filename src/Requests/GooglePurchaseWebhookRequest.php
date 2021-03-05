<?php

namespace JinseokOh\PurchaseWebhooks\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class GoogleDeveloperNotificationRequest
 * @package Imdhemy\Purchases\Http\Requests
 */
class GooglePurchaseWebhookRequest extends FormRequest
{
    /**
     * Validates the request body
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'message' => ['required', 'array'],
            'message.data' => ['required'],
        ];
    }

    /**
     * Authorizes the request
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return string
     */
    public function getData(): string
    {
        return $this->get('message')['data'];
    }
}
