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
        Schema::create('tafseer', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('surah_id');
            $table->foreign('surah_id')->references('id')->on('surah');
            $table->unsignedBigInteger('ayah_id');
            $table->foreign('ayah_id')->references('id')->on('ayah');
            $table->longText('simple_tafseer');
            $table->longText('full_tafseer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tafseer');
    }
};
