<?php

namespace App\Http\Services\Auth;

use App\Events\User\UserRegistered;
use App\Repository\UserRepository\EloquentUserRepository;
use App\Repository\OTPRepository\EloquentOTPRepository;
use Illuminate\Http\JsonResponse;
use App\Models\User;

class AuthServices
{
    /**
     * login user with JWT driver
     *
     * @param array<string, string> $credentials
     * @return string
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function loginToJWT($credentials): string
    {
        if (!$token = auth()->attempt($credentials)) {
            throw new \Illuminate\Auth\AuthenticationException('Invalid credentials');
        }

        return $token;
    }

    /**
     * register user
     *
     * @param array<string, string> $data
     * @return array<string, mixed>
     */
    public function registerUser($data): array
    {
        $user = (new EloquentUserRepository())->RegisterNewUser($data);
        event(new UserRegistered($user));
        $token = auth()->login($user);
        return [
            'token' => $token,
            'user' => $user,
        ];
    }

    /**
     * resend OTP
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function resendOTP(User $user): JsonResponse
    {
        event(new UserRegistered($user, true));
        return response()->json([
            'message' => 'OTP sent successfully'
        ]);
    }

    /**
     * verify OTP
     *
     * @param \App\Models\User $user
     * @param string $otp
     * @return \Illuminate\Http\JsonResponse
     */
    public function verifyOTP(User $user, string $otp): JsonResponse
    {
        $otp = (new EloquentOTPRepository())->validateOTP($user, $otp);
        if(!$otp){
            return response()->json([
                'message' => 'Invalid OTP'
            ], 422);
        }else{
            return response()->json([
                'message' => 'OTP verified successfully'
            ]);
        }
    }
}
