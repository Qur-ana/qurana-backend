<?php

namespace App\Models\Feature\PrayerTimes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $table = 'city';

    protected $fillable = [
        'external_id',
        'name',
    ];
}
