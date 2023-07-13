<?php

namespace App\Models\Feature\Quran;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surah extends Model
{
    use HasFactory;

    protected $table = 'surah';
    protected $fillable = [
        'number',
        'name',
        'name_latin',
        'number_of_ayah',
        'place',
        'meaning_id',
        'description_id',
        'audio',
    ];

    public function ayah()
    {
        return $this->hasMany(Ayah::class);
    }

    public function tafseer()
    {
        return $this->hasMany(Tafseer::class);
    }
}
