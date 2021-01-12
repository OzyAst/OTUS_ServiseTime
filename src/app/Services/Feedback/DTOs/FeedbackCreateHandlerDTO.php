<?php

namespace App\Services\Feedback\DTOs;

/**
 * @property-read $name
 * @property-read $email
 * @property-read $text
 */
class FeedbackCreateHandlerDTO
{
    protected string $name;
    protected string $email;
    protected string $text;

    private function __construct(
        string $name,
        string $email,
        string $text
    ) {
        $this->name = $name;
        $this->email = $email;
        $this->text = $text;
    }

    public static function fromArray(array $data)
    {
        return new static(
            $data['name'],
            $data['email'],
            $data['text'],
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'text' => $this->text,
        ];
    }
}
