<?php

namespace App\Service;

interface InPostServiceInterface
{
    public function fetchData(string $city): array;
}
