<?php 

namespace Kepsondiaz\WaveHttpClient;

use Illuminate\Support\Facades\Http;
use Kepsondiaz\HttpParsedResponse\HttpParsedResponse;



class WaveHttpClient
{
    public function balance(string $apiToken)
    {
        $response = Http::withHeader('idempotency-key', str()->uuid()->toString())
            ->withToken($apiToken)
            ->acceptJson()
            ->get('https://api.wave.com/v1/balance');

        return new HttpParsedResponse($response);
    }

    /*
        * create a new payout
    */
    public function payout(string $apiToken, string $recipient, float $amount, ?string $client_reference, ?string $name, ?string $national_id, ?string $payment_reason): HttpParsedResponse
    {
        $response = Http::withHeader('idempotency-key', str()->uuid()->toString())
            ->withToken($apiToken)
            ->acceptJson()
            ->post('https://api.wave.com/v1/payout', [
                'currency'                  => 'XOF',
                'receive_amount'            => (string) $amount,
                'mobile'                    => $recipient,
                'client_reference'          => $client_reference,
                'name'                      => $name,
                'national_id'               => $national_id,
                'payment_reason'            => $payment_reason,
            ]);

        logger()->debug('WaveHttpClient@payout', [
            'request' => [
                'apiToken'          => $apiToken,
                'mobile'            => $recipient,
                'amount'            => $amount,
                'client_reference'  => $client_reference,
                'name'              => $name,
                'national_id'       => $national_id,
                'payment_reason'    => $payment_reason,
            ],
            'response' => [
                $response->json(),
                $response->status(),
            ],
        ]);

        return new HttpParsedResponse($response);
    }

    /**
     * Retrieves a single payout.
     */
    public function getPayout(string $apiToken, string $id): HttpParsedResponse
    {
        $response = Http::withToken($apiToken)
            ->acceptJson()
            ->get('https://api.wave.com/v1/payout', [
                'id' => $id,
            ]);

        return new HttpParsedResponse($response);
    }

    /**
     * Retrieves a list of payouts based on the provided query parameters.
    */

    public function searchPayouts(string $apiToken, string $client_reference): HttpParsedResponse
    {
        $response = Http::withToken($apiToken)
            ->acceptJson()
            ->get('https://api.wave.com/v1/payouts/search', [
                'client_reference' => $client_reference,
            ]);

        return new HttpParsedResponse($response);
    }

     /**
      * Create payout batch.
      */

    public function createPayoutBatch(string $apiToken, array $payouts): HttpParsedResponse
    {
        $response = Http::withHeader('idempotency-key', str()->uuid()->toString())
            ->withToken($apiToken)
            ->acceptJson()
            ->post('https://api.wave.com/v1/payout-batch', [
                'payouts'  => $payouts,
            ]);

        logger()->debug('WaveHttpClient@createPayoutBatch', [
            'request' => [
                'payouts' => $payouts,
            ],
            'response' => [
                $response->json(),
                $response->status(),
            ],
        ]);

        return new HttpParsedResponse($response);
    }

    /**
    * get payout batch.
    */
    public function getPayoutBatch(string $apiToken, string $id): HttpParsedResponse
    {
        $response = Http::withToken($apiToken)
        ->acceptJson()
        ->get('https://api.wave.com/v1/payout-batch', [
                'id' => $id,
        ]);

        return new HttpParsedResponse($response);
    }

    public function payoutB2B(string $apiToken, string $recipient, float $amount): HttpParsedResponse
    {
        $response = Http::withHeader('idempotency-key', str()->uuid()->toString())
            ->withToken($apiToken)
            ->acceptJson()
            ->post('https://api.wave.com/v1/b2b/payout', [
                'currency'           => 'XOF',
                'receive_amount'     => (string) $amount,
                'recipient_id'       => $recipient,
                'fee_payment_method' => 'SENDER_PAYS',
            ]);

        logger()->debug('WaveHttpClient@b2bPayout', [
            'request' => [
                'recipient_id' => $recipient,
                'amount'       => $amount,
            ],
            'response' => [
                $response->json(),
                $response->status(),
            ],
        ]);

        return new HttpParsedResponse($response);
    }

    public function payoutB2BRecipientPays(string $apiToken, string $recipient, float $amount): HttpParsedResponse
    {
        $response = Http::withHeader('idempotency-key', str()->uuid()->toString())
            ->withToken($apiToken)
            ->acceptJson()
            ->post('https://api.wave.com/v1/b2b/payout', [
                'currency'           => 'XOF',
                'send_amount'        => (string) $amount,
                'recipient_id'       => $recipient,
                'fee_payment_method' => 'RECIPIENT_PAYS',
            ]);

        logger()->debug('WaveHttpClient@payoutB2BRecipientPays', [
            'request' => [
                'recipient_id' => $recipient,
                'amount'       => $amount,
            ],
            'response' => [
                $response->json(),
                $response->status(),
            ],
        ]);

        return new HttpParsedResponse($response);
    }
}