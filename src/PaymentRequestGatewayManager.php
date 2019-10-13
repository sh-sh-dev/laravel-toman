<?php

namespace AmirrezaNasiri\LaravelToman;

use Illuminate\Support\Manager;
use AmirrezaNasiri\LaravelToman\Clients\GuzzleClient;
use AmirrezaNasiri\LaravelToman\Gateways\Zarinpal\Requester as ZarinpalPaymentRequest;

class PaymentRequestGatewayManager extends Manager
{
    /**
     * Get the default payment gateway name.
     *
     * @return string
     */
    public function getDefaultDriver()
    {
        return config('toman.default');
    }

    /**
     * Create Zarinpal gateway driver.
     * @return ZarinpalPaymentRequest
     */
    public function createZarinpalDriver()
    {
        return ZarinpalPaymentRequest::make(
            config('toman.gateways.zarinpal'),
            app(GuzzleClient::class)
        );
    }
}
