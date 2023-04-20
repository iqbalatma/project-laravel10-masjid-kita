<?php

namespace App\Contracts\Interfaces\Auth;

use Illuminate\Http\Request;

interface AuthServiceInterface
{
    public function getLoginData(): array;
    public function authenticate(array $requestedData): bool;
    public function logout(Request $requestedData): void;
}
