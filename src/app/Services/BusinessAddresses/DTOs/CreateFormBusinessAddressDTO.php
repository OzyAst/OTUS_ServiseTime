<?php

namespace App\Services\BusinessAddresses\DTOs;

class CreateFormBusinessAddressDTO extends FormBusinessAddressDTO
{
    protected string $address;
    private string $latitude;
    private string $longitude;
    protected int $business_id;

    private function __construct(
        string $address,
        string $latitude,
        string $longitude,
        int $business_id
    )
    {
        $this->address = $address;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->business_id = $business_id;
    }

    public static function fromArray(array $data)
    {
        return new static(
            $data['address'],
            $data['latitude'],
            $data['longitude'],
            $data['business_id']
        );
    }
}
