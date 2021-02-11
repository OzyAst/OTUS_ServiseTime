<?php

namespace App\Services\Api\Translators;

use Illuminate\Database\Eloquent\Collection;

/**
 * Базовый класс транслятора
 */
abstract class ApiBaseTranslator
{
    public function translateAll(Collection $collection): array
    {
        $result = [];
        foreach ($collection as $item) {
            $result[] = static::translate($item);
        }
        return $result;
    }

    abstract public function translate($item);
}
