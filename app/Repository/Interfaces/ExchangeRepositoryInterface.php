<?php

namespace App\Repository\Interfaces;

use App\Models\Exchange;

interface ExchangeRepositoryInterface
{
    /**
     * @param Exchange $exchange
     * Insert Exchange Repository
     *
     * @return Exchange
     */
    public function saveRate(Exchange $exchange): Exchange;

    public function findFromAndTo(string $from, string $to);
}
