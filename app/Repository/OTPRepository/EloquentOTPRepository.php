<?php

namespace App\Repository\OTPRepository;

use App\Models\Auth\OTP;
use App\Models\User;

class EloquentOTPRepository implements OTPRepository
{
    /**
     * Create new OTP
     *
     * @param array<string, string> $data
     * @return \App\Models\OTP
     */
    public function createOTP(string $phone): OTP
    {
        $data['otp'] = $this->generateOTP();
        $data['expires_at'] = now()->addMinutes(5);
        $data['phone'] = $phone;
        return OTP::create($data);
    }

    /**
     * Validate OTP
     *
     * @param array<string, string> $data
     * @return \App\Models\OTP
     */
    public function validateOTP(User $user, string $code): bool
    {
        try {
            $otp = OTP::where('phone', $user->phone)->where('expired_at', '>', now())->first();
            if ($otp->otp == $code) {
                $user->update(['phone_verified_at' => now()]);
                return true;
            }
            return false;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Update OTP
     *
     * @param array<string, string> $data
     * @return \App\Models\OTP
     */
    public function resendOTP(string $phone): OTP|bool
    {
        try {
            $otp = OTP::where('phone', $phone)->where('expired_at', '>', now())->first();
            $data['otp'] = $this->generateOTP();
            $data['expires_at'] = now()->addMinutes(5);
            $otp->update($data);
            return $otp;
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    /**
     * Generate OTP
     *
     * @return string
     */
    public function generateOTP(): string
    {
        $otp = rand(100000, 999999);
        return $otp;
    }
}
