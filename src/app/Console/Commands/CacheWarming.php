<?php

namespace App\Console\Commands;

use App\Console\Commands\CacheWarmingRules\BusinessesWarmingRule;
use App\Console\Commands\CacheWarmingRules\CacheWarmingRule;
use Illuminate\Console\Command;

class CacheWarming extends Command
{
    protected $signature = 'cache:warming';
    protected $description = 'Прогрев кэша';

    /**
     * Классы с правилами для прогрева кэша
     */
    private array $cacheRules = [
        BusinessesWarmingRule::class,
    ];

    /**
     * Вернет сервис который содержит метод использующий кэш
     * @param string $class
     * @return \Illuminate\Contracts\Foundation\Application|mixed
     */
    private function getService(string $class)
    {
        return app($class);
    }

    /**
     * Execute the console command.
     * @return mixed
     */
    public function handle()
    {
        $cacheRules = $this->getCacheRules();
        $bar = $this->output->createProgressBar(count($this->cacheRules));
        $bar->start();

        foreach ($cacheRules as $rule) {
            /**
             * @var CacheWarmingRule $rule
             */
            $class = $rule->getClass();
            $method = $rule->getMethod();
            $params = $rule->getIterationParams();

            foreach ($params as $param) {
                $this->getService($class)->$method(...$param);
            }
            $bar->advance();
        }

        $bar->finish();
        $this->line("");
        $this->info("Кэш успешно прогрет");
    }

    /**
     * Вернет правила прогрева по очередно
     * @return iterable
     */
    private function getCacheRules(): iterable
    {
        foreach ($this->cacheRules as $rule) {
            yield new $rule;
        }
    }
}
