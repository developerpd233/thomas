<?php


namespace App\paypal;


class Paypal
{
    protected $apiContext, $client_id, $secret;
    
    public function __construct()
    {
        // Detect if we are running in live mode or sandbox
        if (config('paypal.settings.mode') == 'live') {
            $this->client_id = config('paypal.pay_id');
            $this->secret = config('paypal.pay_secret');
        } else {
            $this->client_id = config('paypal.sandbox_client_id');
            $this->secret = config('paypal.sandbox_secret');
        }
        
        $this->apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                $this->client_id,     // ClientID
                $this->secret //client secret
            )
        );
        $this->apiContext->setConfig(config('paypal.settings'));
    }
}
