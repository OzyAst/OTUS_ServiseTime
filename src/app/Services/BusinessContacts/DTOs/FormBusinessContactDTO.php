<?php

namespace App\Services\BusinessContacts\DTOs;

use App\Services\DTO\DTO;

class FormBusinessContactDTO extends DTO
{
    protected string $contact;
    protected int $type_id;
    protected int $business_address_id;
}
