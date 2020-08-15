<?php

namespace App\Services\BusinessContacts\DTOs;

use App\Services\DTO\DTO;

class FormBusinessContactDTO extends DTO
{
    protected string $contact;
    protected int $type_id;
    protected int $business_address_id;

    private function __construct(
        string $contact,
        int $type_id,
        int $business_address_id
    )
    {
        $this->contact = $contact;
        $this->type_id = $type_id;
        $this->business_address_id = $business_address_id;
    }

    public static function fromArray(array $data)
    {
        return new static(
            $data['contact'],
            $data['type_id'],
            $data['business_address_id'],
        );
    }
}
