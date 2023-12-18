<?php

namespace App\Repository;

use App\Models\Exchange;
use App\Repository\Interfaces\ExchangeRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class ExchangeRepository implements ExchangeRepositoryInterface
{
    private Model $model;

    public function __construct(Exchange $model)
    {
        $this->model = $model;
    }

    /**
     * @param Exchange $exchange
     * Insert Exchange Repository
     *
     * @return Exchange
     */
    public function saveRate(Exchange $exchange): Exchange
    {
        $exchange->save();

        return $exchange;
    }

    public function findFromAndTo(string $from, string $to)
    {
        return $this->model->newQuery()
            ->where('from', $from)
            ->where('to', $to)
            ->orderByDesc('created_at')
            ->first();
    }
}
