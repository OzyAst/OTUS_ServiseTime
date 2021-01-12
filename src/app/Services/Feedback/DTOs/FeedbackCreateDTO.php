<?php

namespace App\Services\Feedback\DTOs;

/**
 * @property-read $name
 * @property-read $email
 * @property-read $text
 * @property-read $ip
 * @property-read $user_id
 */
class FeedbackCreateDTO
{
    private string $name;
    private string $email;
    private string $text;
    private ?string $ip;
    private ?int $user_id;

    private function __construct(
        string $name,
        string $email,
        string $text,
        ?string $ip = null,
        ?int $user_id = null
    ) {
        $this->name = $name;
        $this->email = $email;
        $this->text = $text;
        $this->ip = $ip;
        $this->user_id = $user_id;
    }

    public static function fromArray(array $data)
    {
        return new static(
            $data['name'],
            $data['email'],
            $data['text'],
            $data['ip'] ?? null,
            $data['user_id'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'text' => $this->text,
            'ip' => $this->ip,
            'user_id' => $this->user_id,
        ];
    }
}
