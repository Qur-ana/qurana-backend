<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\VerifyOTPRequest;
use App\Http\Services\Auth\AuthServices;
use App\Http\Resources\Auth\LoginResource;
use App\Http\Resources\Auth\RegisterResource;
use App\Http\Resources\Auth\UserResource;
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
        $this->middleware('auth:api')->except(['login', 'register']);
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
            new LoginResource($service->loginToJWT($request->validated()))
        );
    }

    /**
     * register user
     *
     * @param \App\Http\Requests\Auth\RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request, AuthServices $service): JsonResponse
    {
        return response()->json(
            new RegisterResource($service->registerUser($request->validated()))
        );
    }

    /**
     * resend OTP
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function resendOTP(AuthServices $service): JsonResponse
    {
        return $service->resendOTP(auth()->user());
    }

    /**
     * verify OTP
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function verifyOTP(VerifyOTPRequest $request, AuthServices $service): JsonResponse
    {
        return $service->verifyOTP(auth()->user(), $request->otp);
    }

    /**
     * logout user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth()->logout();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    /**
     * get user
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function user(): JsonResponse
    {
        return response()->json(
            new UserResource(auth()->user())
        );
    }
}
