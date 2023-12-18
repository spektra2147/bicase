<?php

namespace App\Services\Interfaces;

use App\Http\Requests\ConvertRequest;

interface ExchangeServiceInterface
{
    /**
     * @return array
     *
     * Returns defined currencies
     */
    public function getEnabledCurrencies(): array;

    /**
     * @param ExchangeGatewayInterface $gateway
     * @return void
     *
     * Synchronizes the current rate
     */
    public function sync(ExchangeGatewayInterface $gateway): void;

    /**
     * @param ConvertRequest $request
     * @return object
     *
     * Convert Currency
     */
    public function convert(ConvertRequest $request): object;
}
