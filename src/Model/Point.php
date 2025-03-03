<?php

namespace App\Model;

class Point
{
    public function __construct(private string $name, private Address $address)
    {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAddress(): Address
    {
        return $this->address;
    }
}
