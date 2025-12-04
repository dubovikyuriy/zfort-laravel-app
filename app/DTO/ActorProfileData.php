<?php

namespace App\DTO;

readonly class ActorProfileData
{
    public function __construct(
        public string $first_name,
        public string $last_name,
        public string $address,
        public ?string $height = null,
        public ?string $weight = null,
        public ?string $gender = null,
        public ?int $age = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            first_name: $data['first_name'] ?? '',
            last_name:  $data['last_name']  ?? '',
            address:    $data['address']    ?? '',
            height:     $data['height']     ?? null,
            weight:     $data['weight']     ?? null,
            gender:     $data['gender']     ?? null,
            age:        isset($data['age']) ? (int)$data['age'] : null,
        );
    }

    public function toArray(): array
    {
        return [
            'first_name' => $this->first_name,
            'last_name'  => $this->last_name,
            'address'    => $this->address,
            'height'     => $this->height,
            'weight'     => $this->weight,
            'gender'     => $this->gender,
            'age'        => $this->age,
        ];
    }
}
