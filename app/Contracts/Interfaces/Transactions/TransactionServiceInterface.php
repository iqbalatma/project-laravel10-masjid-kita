<?php

namespace App\Contracts\Interfaces\Transactions;


interface TransactionServiceInterface
{
    public function getAllData(string $type): array;
}
