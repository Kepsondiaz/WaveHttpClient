<?php

namespace Kepsondiaz\WaveHttpClient\Facades;


use Illuminate\Support\Facades\Facade;

/**
 * @method static HttpParsedResponse balance(string $apiToken) Récupère le solde du compte Wave
 * @method static HttpParsedResponse payout(string $apiToken, string $recipient, float $amount, ?string $client_reference, ?string $name, ?string $national_id, ?string $payment_reason) Effectue un paiement vers un numéro de téléphone
 * @method static HttpParsedResponse getPayout(string $apiToken, string $id) Récupère les détails d'un paiement spécifique
 * @method static HttpParsedResponse searchPayouts(string $apiToken, string $client_reference) Recherche des paiements par référence client
 * @method static HttpParsedResponse createPayoutBatch(string $apiToken, array $payouts) Crée un lot de paiements multiples
 * @method static HttpParsedResponse getPayoutBatch(string $apiToken, string $id) Récupère les détails d'un lot de paiements
 */
class WaveHttpClient extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'WaveHttpClient';
    }
}
