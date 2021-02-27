<?php

namespace App\Services\DTO;

use Illuminate\Support\Collection;

abstract class DTO
{
    const PREFIX_SETTER = "set";

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
            // Если это экземпляр DTO то переведем в массив и его
            if ($this->$property instanceof DTO) {
                $array[$property] = $this->$property->toArray();
            } else {
                $array[$property] = $this->$property;
            }
        }
        return $array;
    }

    /**
     * Заполняем dto из массива
     * @param array $data
     * @return DTO
     */
    public static function fromArray(array $data): self
    {
        $dto = new static();
        $properties = get_class_vars(static::class);

        if (empty($data))
            return $dto;

        foreach ($properties as $key => $param) {
            // Если в переданном массиве нет нужного значения
            if (!array_key_exists($key, $data)) {
                throw new \ArgumentCountError("Передано недостаточное количество аргументов ($key)");
            }

            $method = self::PREFIX_SETTER . $key;
            // Если у свойства есть сеттер, добавим значение через него
            if (method_exists($dto, $method)) {
                $dto->$method($data[$key]);
            } else {
                $dto->$key = $data[$key];
            }
        }

        return $dto;
    }

    /**
     * Заполнить массив dto из массива
     * @param array $data
     * @return array
     */
    public static function allFromArray(array $data): array
    {
        return array_map(function ($array) {
            return self::fromArray($array);
        }, $data);
    }

    /**
     * Заполнить массив dto из колллекции
     * @param Collection $collection
     * @return array
     */
    public static function allFromCollection(Collection $collection): array
    {
        $collection = json_decode($collection, true);
        return self::allFromArray($collection);
    }
}
