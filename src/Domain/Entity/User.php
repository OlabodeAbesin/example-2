<?php

namespace App\Domain\Entity;

class User
{

    public function __construct(
        private string $id,
        private string $email,
        private string $phoneNumber,
        private string $deviceId,
    )
    {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    public function getDeviceId(): string
    {
        return $this->deviceId;
    }

}
