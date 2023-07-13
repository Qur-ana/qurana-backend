<?php

namespace App\Models\Feature\AsmaulHusna;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsmaulHusna extends Model
{
    use HasFactory;

    protected $table = 'asmaul_husna';

    protected $fillable = [
        'name',
        'name_latin',
        'meaning_id'
    ];

}
