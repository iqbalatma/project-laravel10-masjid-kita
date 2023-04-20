<?php

namespace App\Services\Auth;

use App\Contracts\Interfaces\Auth\AuthServiceInterface;
use App\Repositories\UserRepository;
use App\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\Auth;

class AuthService extends BaseService implements AuthServiceInterface
{
    protected $repository;
    public function __construct()
    {
        $this->repository = new UserRepository();
    }

    /**
     * Use to show data for login view
     *
     * @return array
     */
    public function getLoginData(): array
    {
        return [
            "title" => "Login"
        ];
    }


    /**
     * Use to authenticate user
     *
     * @param array $requestedData
     * @return boolean
     */
    public function authenticate(array $requestedData): bool
    {
        $rememberme = false;
        if (isset($requestedData["rememberme"])) {
            $rememberme = $requestedData["rememberme"];

            unset($requestedData["rememberme"]);
        }
        if (Auth::attempt($requestedData, $rememberme)) {
            return true;
        }
        return false;
    }
}
