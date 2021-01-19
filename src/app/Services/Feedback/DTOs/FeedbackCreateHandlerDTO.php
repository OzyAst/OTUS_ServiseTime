<?php

namespace App\Services\Feedback\DTOs;

/**
 * @property-read $name
 * @property-read $email
 * @property-read $business_id
 * @property-read $text
 */
class FeedbackCreateHandlerDTO
{
    protected string $name;
    protected string $email;
    protected int $business_id;
    protected string $text;

    private function __construct(
        string $name,
        string $email,
        int $business_id,
        string $text
    ) {
        $this->name = $name;
        $this->email = $email;
        $this->business_id = $business_id;
        $this->text = $text;
    }

    public static function fromArray(array $data)
    {
        return new static(
            $data['name'],
            $data['email'],
            $data['business_id'],
            $data['text'],
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'business_id' => $this->business_id,
            'text' => $this->text,
        ];
    }
}
