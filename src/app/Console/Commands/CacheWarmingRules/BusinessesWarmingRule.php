<?php

namespace App\Console\Commands\CacheWarmingRules;

use App\Models\Business;
use App\Services\Businesses\BusinessService;

class BusinessesWarmingRule implements CacheWarmingRule
{
    public function getClass(): string
    {
        return BusinessService::class;
    }

    public function getMethod(): string
    {
        return "findCachedBusiness";
    }

    public function getIterationParams(): iterable
    {
        // TODO: Получаем топ 20 бизнесов. Греем только для них
        $businesses = Business::all();
        foreach ($businesses as $business) {
            yield [$business->id];
        }
    }
}
