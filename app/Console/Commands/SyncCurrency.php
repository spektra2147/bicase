<?php

namespace App\Console\Commands;

use App\Services\Interfaces\ExchangeServiceInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;

class SyncCurrency extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'converter:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Starts Exchange synchronization.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(ExchangeServiceInterface $exchangeService)
    {
        $this->info('....Sync Started....');

        $gateway = config('converter.default_gateway');

        $exchangeService->sync(App::make($gateway));

        $this->info('....[Sync Completed]....');
    }
}
