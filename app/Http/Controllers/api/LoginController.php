<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Services\LoginService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class LoginController extends Controller
{

    protected $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    public function login(LoginRequest $request) {

        $validated = $request->validated();     // Performing validation for login request

        $data = $this->loginService->login($validated);     // Call auth service for validated data
        if (!$data)
            return response(['message' => 'Invalid credentials'], ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
        return response(['token' => $data[0], 'is_admin' => $data[1], 'has_farm' => $data[2]], ResponseAlias::HTTP_OK);

    }

    public function logout() {

        $this->loginService->logout();
        return response(['message' => 'logged-out'], ResponseAlias::HTTP_OK);

    }

}
