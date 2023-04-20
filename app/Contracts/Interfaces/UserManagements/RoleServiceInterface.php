<?php

namespace App\Contracts\Interfaces\UserManagements;

interface RoleServiceInterface
{
    public function getAllData(): array;
    public function getCreateData(): array;
    public function getEditData(int $id): array;
    public function addNewData(array $requestedData): array;
    public function deleteDataById(int $id): array;
    public function updateDataById(int $id, array $requestedData): array;
}
