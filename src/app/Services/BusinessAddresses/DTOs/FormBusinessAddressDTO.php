<?php

namespace App\Services\BusinessAddresses\DTOs;

use App\Services\DTO\DTO;

class FormBusinessAddressDTO extends DTO
{
    protected string $address;
    protected string $latitude;
    protected string $longitude;
}
