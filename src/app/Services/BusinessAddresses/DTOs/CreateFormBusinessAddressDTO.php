<?php

namespace App\Services\BusinessAddresses\DTOs;

class CreateFormBusinessAddressDTO extends FormBusinessAddressDTO
{
    protected string $address;
    protected int $business_id;

    private function __construct(
        string $address,
        int $business_id
    )
    {
        $this->address = $address;
        $this->business_id = $business_id;
    }

    public static function fromArray(array $data)
    {
        return new static(
            $data['address'],
            $data['business_id']
        );
    }
}
