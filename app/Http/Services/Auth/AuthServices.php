<?php

namespace App\Http\Services\Auth;

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
}