<?php

namespace App\Models\Feature\Quran;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tafseer extends Model
{
    use HasFactory;

    protected $table = 'tafseer';
    protected $fillable = [
        'surah_id',
        'ayah_id',
        'simple_tafseer',
        'full_tafseer'
    ];

    public function surah()
    {
        return $this->belongsTo(Surah::class);
    }

    public function ayah()
    {
        return $this->belongsTo(Ayah::class);
    }
}
