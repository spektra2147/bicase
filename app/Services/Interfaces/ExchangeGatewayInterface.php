<?php

namespace App\Services\Interfaces;

interface ExchangeGatewayInterface
{
    /**
     * @return mixed
     *
     * Fetch currencies
     */
    public function fetch();
}
