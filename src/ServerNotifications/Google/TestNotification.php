<?php

namespace JinseokOh\PurchaseWebhooks\ServerNotifications\Google;

class TestNotification
{
    /**
     * @var string
     */
    protected $version;

    /**
     * TestNotification constructor.
     * @param string $version
     */
    public function __construct(string $version)
    {
        $this->version = $version;
    }

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }
}
