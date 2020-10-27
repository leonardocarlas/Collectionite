<?php

namespace Test;

use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;

ini_set('error_reporting', E_ALL); // or error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

class TestHarness
{
    public static function client()
    {
        return new PayPalHttpClient(self::environment());
    }
    public static function environment()
    {
        $clientId = getenv("CLIENT_ID") ?: "ATaeq_M12RICGMFIYdeHED_rKYc5o0UUT7BxGfTOBlgtmE0cDStu0KMSUfX7YzAloMOZMqE1yu0h7rZN";
        $clientSecret = getenv("CLIENT_SECRET") ?: "EIrudUEUuRrX7bbUzeIhHc6kRP-xiBKC2sAOttNuDslpIjMcxZuXfBqHDD3SYq-SyVITmEVc8Sbc1s3Y";
        return new SandboxEnvironment($clientId, $clientSecret);
    }
}
