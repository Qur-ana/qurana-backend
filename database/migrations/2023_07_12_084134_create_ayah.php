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
        Schema::create('ayah', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->unsignedBigInteger('surah_id');
            $table->foreign('surah_id')->references('id')->on('surah');
            $table->longText('text_arabic');
            $table->longText('text_latin');
            $table->longText('text_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ayah');
    }
};
