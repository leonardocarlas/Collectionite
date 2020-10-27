<?php

namespace Sample;

use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\ProductionEnvironment;

ini_set('error_reporting', E_ALL); // or error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

class PayPalClient
{
    /**
     * Returns PayPal HTTP client instance with environment that has access
     * credentials context. Use this instance to invoke PayPal APIs, provided the
     * credentials have access.
     */
    public static function client()
    {
        return new PayPalHttpClient(self::environment());
    }

    /**
     * Set up and return PayPal PHP SDK environment with PayPal access credentials.
     * This sample uses SandboxEnvironment. In production, use LiveEnvironment.
     */
    public static function environment()
    {
        $clientId = getenv("CLIENT_ID") ?: "AUiQObjWwMGD1n6r8V5Ha27R3ijRQk-Mcmt4iP5rQaDh57ralkj0EakZzUdnb9BWyqU2ucJO5RAUYzDi";
        $clientSecret = getenv("CLIENT_SECRET") ?: "EKIQuJJEwdsp0cASooThAyKhJW14iCDc7pe31abpH5AFPlrk-x26-POBZGhosw2yO9Q1VRw8pYeoSDBz";
        return new ProductionEnvironment($clientId, $clientSecret);
    }
}
?>