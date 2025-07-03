<?php

namespace Kepsondiaz\WaveHttpClient\Manager;

use Kepsondiaz\WaveHttpClient\WaveHttpClient;

class WaveHttpClientManager
{
    protected WaveHttpClient $client;
    
    public function __construct()
    {
        $this->client = new WaveHttpClient();
    }

    public function balance(string $apiToken)
    {
        return $this->client->balance($apiToken);
    }

    public function payout(string $apiToken, string $recipient, float $amount, ?string $client_reference, ?string $name, ?string $national_id, ?string $payment_reason)
    {
        return $this->client->payout($apiToken, $recipient, $amount, $client_reference, $name, $national_id, $payment_reason);
    }

    public function getPayout(string $apiToken, string $id)
    {
        return $this->client->getPayout($apiToken, $id);
    }

    public function searchPayouts(string $apiToken, string $client_reference)
    {
        return $this->client->searchPayouts($apiToken, $client_reference);
    }

    public function createPayoutBatch(string $apiToken, array $payouts)
    {
        return $this->client->createPayoutBatch($apiToken, $payouts);
    }

    public function getPayoutBatch(string $apiToken, string $id)
    {
        return $this->client->getPayoutBatch($apiToken, $id);
    }

    public function payoutB2B(string $apiToken, string $recipient, float $amount)
    {
        return $this->client->payoutB2B($apiToken, $recipient, $amount);
    }

    public function payoutB2BRecipientPays(string $apiToken, string $recipient, float $amount)
    {
        return $this->client->payoutB2BRecipientPays($apiToken, $recipient, $amount);
    }
}
