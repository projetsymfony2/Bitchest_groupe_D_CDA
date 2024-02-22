<?php
namespace App\Service;

use GuzzleHttp\Client;

class CryptoCompareService
{
    private $apiKey;
    private $httpClient;

    public function __construct(string $apiKey)
    {
        $this->apiKey = '53462aa31a6c0d9290506e7576953ea14ae3ee1ce49cb196ad1523f1f76e1897';
        $this->httpClient = new Client(['base_uri' => 'https://min-api.cryptocompare.com/']);
    }

    public function getCoinPrices(string $symbol): array
    {
        $response = $this->httpClient->request('GET', 'data/price', [
            'query' => [
                'fsym' => $symbol,
                'tsyms' => 'EUR', 
                'api_key' => $this->apiKey,
            ]
        ]);

        $data = json_decode($response->getBody(), true);

        // Traitez les données et retournez-les sous la forme nécessaire pour votre application
        return [
            'symbol' => $symbol,
            'price' => $data['EUR'],
        ];
    }

    // Ajoutez d'autres méthodes pour d'autres fonctionnalités nécessaires
}
