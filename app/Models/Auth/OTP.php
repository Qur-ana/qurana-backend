<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OTP extends Model
{
    use HasFactory;

    protected $table = 'otp';

    protected $fillable = [
        'phone',
        'otp',
        'expired_at'
    ];
}
