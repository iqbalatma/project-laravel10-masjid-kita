<?php

namespace App\Contracts\Interfaces\Auth;

interface AuthServiceInterface
{
    public function getLoginData(): array;
    public function authenticate(array $requestedData): bool;
}
