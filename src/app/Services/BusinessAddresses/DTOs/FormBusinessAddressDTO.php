<?php

namespace App\Services\BusinessAddresses\DTOs;

use App\Services\DTO\DTO;

class FormBusinessAddressDTO extends DTO
{
    protected string $address;

    private function __construct(
        string $address
    )
    {
        $this->address = $address;
    }

    public static function fromArray(array $data)
    {
        return new static(
            $data['address'],
        );
    }
}
