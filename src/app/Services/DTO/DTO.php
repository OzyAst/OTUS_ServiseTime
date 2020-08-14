<?php

namespace App\Services\DTO;

class DTO
{
    /**
     * Вернет массив с доступными свойствами
     * @return array
     */
    public function toArray(): array
    {
        $array = [];
        $properties = array_keys(get_class_vars(static::class));

        foreach ($properties as $property) {
            $array[$property] = $this->$property;
        }
        return $array;
    }
}
