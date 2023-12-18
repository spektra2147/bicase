<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConvertRequest;
use App\Services\Interfaces\ExchangeServiceInterface;

class ExchangeController extends Controller
{
    private ExchangeServiceInterface $exchangeService;

    public function __construct(ExchangeServiceInterface $exchangeServiceInterface)
    {
        $this->exchangeService = $exchangeServiceInterface;
    }

    /**
     * @param ConvertRequest $request
     * @return object
     */
    public function convert(ConvertRequest $request): object
    {
        return $this->exchangeService->convert($request);
    }
}
