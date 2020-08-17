<?php

namespace App\Services\BusinessAddresses\DTOs;

use App\Services\DTO\DTO;

class FormBusinessAddressDTO extends DTO
{
    protected string $address;
    protected string $latitude;
    protected string $longitude;

    protected function __construct(
        string $address,
        string $latitude,
        string $longitude
    )
    {
        $this->address = $address;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    public static function fromArray(array $data)
    {
        return new static(
            $data['address'],
            $data['latitude'],
            $data['longitude'],
        );
    }
}
