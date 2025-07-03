<?php

namespace Kepsondiaz\WaveHttpClient\Facades;


use Illuminate\Support\Facades\Facade;

/**
 * @method static HttpParsedResponse balance(string $apiToken)
 * @method static HttpParsedResponse payout(string $apiToken, string $recipient, float $amount, ?string $client_reference, ?string $name, ?string $national_id, ?string $payment_reason)
 * @method static HttpParsedResponse getPayout(string $apiToken, string $id)
 * @method static HttpParsedResponse searchPayouts(string $apiToken, string $client_reference)
 * @method static HttpParsedResponse createPayoutBatch(string $apiToken, array $payouts)
 * @method static HttpParsedResponse getPayoutBatch(string $apiToken, string $id)
 */
class WaveHttpClient extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'WaveHttpClient';
    }
}
