<?php

namespace App\Contracts\Interfaces\Masters;

interface SubdistrictServiceInterface
{
    public function getAllData(): array;
    public function addNewData(array $requestedData): array;
}
