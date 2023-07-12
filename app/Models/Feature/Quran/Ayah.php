<?php

namespace App\Models\Feature\Quran;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ayah extends Model
{
    use HasFactory;

    protected $table = 'ayah';
    protected $fillable = [
        'number',
        'surah_id',
        'text_arabic',
        'text_latin',
        'text_id',
    ];

    public function surah()
    {
        return $this->belongsTo(Surah::class);
    }
}
