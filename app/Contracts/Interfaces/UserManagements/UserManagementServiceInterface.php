<?php

namespace App\Contracts\Interfaces\UserManagements;

interface UserManagementServiceInterface
{
    public function getAllData(): array;
    public function getEditData(int $id): array;
    public function addNewData(array $requestedData): array;
    public function updateDataById(int $id, array $requestedData): array;
}
