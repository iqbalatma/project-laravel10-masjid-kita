<?php

namespace App\Contracts\Interfaces\Mosques;

interface MosqueTransactionServiceInterface
{
    public function getAllData(int $mosqueId): array;
}
