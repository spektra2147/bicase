<?php

namespace App\Services;

use App\Events\UserApiActivityEvent;
use App\Http\Requests\ConvertRequest;
use App\Models\Exchange;
use App\Repository\Interfaces\ExchangeRepositoryInterface;
use App\Services\Interfaces\ExchangeGatewayInterface;
use App\Services\Interfaces\ExchangeServiceInterface;
use Illuminate\Validation\ValidationException;
use Justfeel\Response\ResponseCodes;
use Justfeel\Response\ResponseResult;

class ExchangeService implements ExchangeServiceInterface
{
    private ExchangeRepositoryInterface $exchangeRepository;

    public function __construct(ExchangeRepositoryInterface $exchangeRepositoryInterface)
    {
        $this->exchangeRepository = $exchangeRepositoryInterface;
    }

    /**
     * @return array
     *
     * Returns defined currencies
     */
    public function getEnabledCurrencies(): array
    {
        return config('converter.enabled_currencies');
    }

    /**
     * @param ExchangeGatewayInterface $gateway
     * @return void
     *
     * Synchronizes the current rate
     */
    public function sync(ExchangeGatewayInterface $gateway): void
    {
        foreach ($this->getEnabledCurrencies() as $enabledCurrency) {
            $convertedCurrencies = $gateway->fetch($enabledCurrency);

            if ($convertedCurrencies) {
                foreach ($convertedCurrencies as $convertedCurrency => $convertedCurrencyRate) {
                    $exchange = new Exchange();
                    $exchange->setAttribute('from', $enabledCurrency);
                    $exchange->setAttribute('to', $convertedCurrency);
                    $exchange->setAttribute('rate', $convertedCurrencyRate);

                    $this->exchangeRepository->saveRate($exchange);
                }
            }
        }
    }

    /**
     * @param ConvertRequest $request
     * @return object
     *
     * Convert Currency
     */
    public function convert(ConvertRequest $request): object
    {
        UserApiActivityEvent::dispatch($request);

        if ($request->validator->fails()) {
            return ResponseResult::generate(false, $request->validator->messages(), ResponseCodes::HTTP_BAD_REQUEST);
        }

        $from = $request->get('from');
        $to = $request->get('to');
        $amount = $request->get('amount');

        try {
            $exchange = $this->exchangeRepository->findFromAndTo($from, $to);

            if (!$exchange) {
                return ResponseResult::generate(false, "Couldn't convert. Please try again later.", ResponseCodes::HTTP_NOT_ACCEPTABLE);
            }

            $rate = $exchange->getAttribute('rate');

            $calculation = number_format($amount * $rate, '4');

            return ResponseResult::generate(true, ["$from-$to" => $calculation], ResponseCodes::HTTP_OK);
        } catch (\Exception $exception) {
            throw ValidationException::withMessages([
                ResponseResult::generate(false, $exception->getMessage(), ResponseCodes::HTTP_BAD_REQUEST),
            ]);
        }
    }
}
