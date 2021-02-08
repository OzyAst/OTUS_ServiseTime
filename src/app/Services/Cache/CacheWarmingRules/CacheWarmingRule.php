<?php

namespace App\Services\Cache\CacheWarmingRules;

interface CacheWarmingRule
{
    /**
     * Класс сервиса, использующий кэш
     * @return string
     */
    public function getClass(): string;

    /**
     * Метод в сервисе, использующий кэш
     * @return string
     */
    public function getMethod(): string;

    /**
     * Массив с параметрами, которые необходимы для прогрева
     * @return iterable
     */
    public function getIterationParams(): iterable;
}
