<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('surah', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->string('name');
            $table->string('name_latin');
            $table->string('number_of_ayah');
            $table->string('place');
            $table->string('meaning_id');
            $table->longText('description_id');
            $table->string('audio');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surah');
    }
};
