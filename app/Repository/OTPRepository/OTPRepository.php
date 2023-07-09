<?php

namespace App\Repository\OTPRepository;
use App\Models\User;

interface OTPRepository{
    public function createOTP(string $phone);
    public function validateOTP(User $user, string $code);
    public function resendOTP(string $phone);
    public function generateOTP();
}