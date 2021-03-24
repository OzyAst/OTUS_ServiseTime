<?php

namespace App\Console\Commands;

use App\Services\Cache\CacheWarmingRules\BusinessesWarmingRule;
use App\Services\Cache\Handlers\WarmUpCacheHandler;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class CacheWarming extends Command
{
    const TIME_CLEAR_BY_CRON = "04:00";

    protected $signature = 'cache:warming';
    protected $description = 'Прогрев кэша';

    private WarmUpCacheHandler $service;

    /**
     * Классы с правилами для прогрева кэша
     */
    private array $cacheRules = [
        BusinessesWarmingRule::class,
    ];

    private function getService(): WarmUpCacheHandler
    {
        return $this->service ?? app(WarmUpCacheHandler::class);
    }

    /**
     * Execute the console command.
     * @return mixed
     */
    public function handle()
    {
        $bar = $this->output->createProgressBar(count($this->cacheRules));

        Cache::flush();

        $bar->start();
        $this->getService()->handle($this->cacheRules, function () use ($bar) {
            $bar->advance();
        });
        $bar->finish();

        $this->line("");
        $this->info("Кэш успешно прогрет");
    }
}
