<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthenticateRequest;
use App\Services\Auth\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    /**
     * Use to autehnticate user
     *
     * @param AuthService $service
     * @param AuthenticateRequest $request
     * @return RedirectResponse
     */
    public function authenticate(AuthService $service, AuthenticateRequest $request): RedirectResponse
    {
        if ($service->authenticate($request->validated())) {
            //FIXME - NEED TO CHANGE REDIRECT USER
            return redirect()->intended(route("dashboard"));
        }

        return redirect()->back()->with("failed", "Email atau password salah !");
    }


    /**
     * Use to show login view
     *
     * @param AuthService $service
     * @return Response
     */
    public function login(AuthService $service): Response
    {
        viewShare($service->getLoginData());
        return response()->view("auth.login");
    }


    /**
     * Description : use to logout account
     *
     * @param AuthService $service dependency injection
     * @param Request $request
     * @return RedirectResponse
     */
    public function logout(AuthService $service, Request $request): RedirectResponse
    {
        $service->logout($request);
        return redirect()->route("auth.login");
    }
}
