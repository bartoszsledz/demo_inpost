<?php

namespace App\Api;

interface ApiClientInterface
{
    public function get(string $url): array;
}
