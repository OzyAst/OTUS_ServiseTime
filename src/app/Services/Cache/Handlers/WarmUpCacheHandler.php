<?php

namespace App\Services\Cache\Handlers;

use App\Services\Cache\CacheWarmingRules\CacheWarmingRule;

class WarmUpCacheHandler
{

    public function handle(array $cacheRules, callable $callbackIteration = null)
    {
        $cacheRules = $this->getCacheRules($cacheRules);

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

            if ($callbackIteration) {
                $callbackIteration();
            }
        }
    }

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
     * Вернет правила прогрева по очередно
     * @param array $cacheRules
     * @return iterable
     */
    private function getCacheRules(array $cacheRules): iterable
    {
        foreach ($cacheRules as $rule) {
            yield new $rule;
        }
    }
}
