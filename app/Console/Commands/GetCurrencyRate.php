<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GetCurrencyRate extends Command
{
    protected $signature = 'get:currency-rate';

    protected $description = 'Получает курсы валют за последние 180 дней';

    public function handle()
    {
        $this->info('Starting command of get currency rate');

        $this->info('Finished command of get currency rate');
    }
}
