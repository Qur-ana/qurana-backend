<?php

namespace App\Http\Services\Auth;
use App\Events\User\UserRegistered;
use App\Repository\UserRepository\EloquentUserRepository;

class AuthServices
{
    /**
     * login user with JWT driver
     *
     * @param array<string, string> $credentials
     * @return string
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function loginToJWT($credentials){
        if (!$token = auth()->attempt($credentials)) {
            throw new \Illuminate\Auth\AuthenticationException('Invalid credentials');
        }

        return $token;
    }

    public function registerUser($data){
        $user = (new EloquentUserRepository())->RegisterNewUser($data);
        event(new UserRegistered($user));
        $token = auth()->login($user);
        return [
            'token' => $token,
            'user' => $user,
        ];
    }
}