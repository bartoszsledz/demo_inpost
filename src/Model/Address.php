<?php

namespace App\Model;

class Address
{
    public function __construct(private string $line1, private string $line2)
    {
    }

    public function getLine1(): string
    {
        return $this->line1;
    }

    public function getLine2(): string
    {
        return $this->line2;
    }
}
