<?php

namespace App\Services\DTO;

class DTO
{
    /**
     * Получить атрибут класса
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        if (property_exists(static::class, $name))
            return $this->$name;
    }

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
