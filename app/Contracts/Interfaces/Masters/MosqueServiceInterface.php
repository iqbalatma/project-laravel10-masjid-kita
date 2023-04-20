<?php

namespace App\Contracts\Interfaces\Masters;

interface MosqueServiceInterface
{
    public function getAllData(): array;
    public function addNewData(array $requestedData): array;
}
