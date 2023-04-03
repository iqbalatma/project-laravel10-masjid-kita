<?php

namespace App\Contracts\Interfaces\Masters;

interface VillageServiceInterface
{
    public function getAllData(): array;
    public function addNewData(array $requestedData): array;
}
