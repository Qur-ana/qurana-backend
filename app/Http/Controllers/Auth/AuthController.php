<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Services\Auth\AuthServices;
use App\Http\Resources\Auth\LoginResource;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api')->except('login');
    }

    /**
     * login user
     *
     * @param \App\Http\Requests\Auth\LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request, AuthServices $service): JsonResponse
    {
        return response()->json(
            new LoginResource($service->loginToJWT($request->only(['email', 'password'])))
        );
    }
}
