<?php

namespace App\Gateways;

use App\Services\Interfaces\ExchangeGatewayInterface;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class ExchangeRateApi implements ExchangeGatewayInterface
{
    /**
     * https://app.exchangerate-api.com/
     *
     * You can get a free API KEY by signing up at the address above.
     */
    private $apiKey = '0c21ed1ce2cd14424d106de3';
    private $endpoint = 'https://v6.exchangerate-api.com/v6';

    private function getApiKey()
    {
        return $this->apiKey;
    }

    private function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * @param $base_currency
     * @return array|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * Returns exchange rate equivalents
     */
    public function fetch($base_currency = 'USD')
    {
        $endpoint = $this->getEndpoint();
        $apiKey = $this->getApiKey();
        $enabledCurrencies = config('converter.enabled_currencies');

        try {
            $client = new Client();
            $response = $client->request('GET', "$endpoint/$apiKey/latest/$base_currency");

            if ($response->getStatusCode() == '200') {
                $response = (array)json_decode($response->getBody()->getContents(), true);
                if (!empty($response)) {
                    return array_intersect_key($response['conversion_rates'], array_flip($enabledCurrencies));
                }
            }

            return null;
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            Log::channel('error-gateway')->error($response->getBody()->getContents());
            return null;
        }
    }
}
