<?php

namespace App\Contracts\Interfaces\Masters;

interface SubdistrictServiceInterface
{
    public function getAllData(): array;
    public function addNewData(array $requestedData): array;
    public function updateDataById(int $id, array $requestedData): array;
    public function deleteDataById(int $id): array;
}
