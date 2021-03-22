<?php

namespace App\Services\Feedback\DTOs;

/**
 * @property-read $name
 * @property-read $email
 * @property-read $business_id
 * @property-read $text
 * @property-read $ip
 * @property-read $user_id
 */
class FeedbackCreateDTO
{
    private string $name;
    private int $business_id;
    private string $email;
    private string $text;
    private ?string $ip;
    private ?int $user_id;

    private function __construct(
        string $name,
        string $email,
        int $business_id,
        string $text,
        ?string $ip = null,
        ?int $user_id = null
    ) {
        $this->name = $name;
        $this->email = $email;
        $this->business_id = $business_id;
        $this->text = $text;
        $this->ip = $ip;
        $this->user_id = $user_id;
    }

    public static function fromArray(array $data)
    {
        return new static(
            $data['name'],
            $data['email'],
            $data['business_id'],
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
            'business_id' => $this->business_id,
            'text' => $this->text,
            'ip' => $this->ip,
            'user_id' => $this->user_id,
        ];
    }
}
