<?php

namespace App\Contracts\Interfaces\Mosques;

interface MosqueTransactionServiceInterface
{
    public function getAllData(int $mosqueId): array;
    public function addNewData(array $requestedData, int $mosqueId): array;
    public function approval(int $mosqueId, int $id, array $requestedData): array;
}
