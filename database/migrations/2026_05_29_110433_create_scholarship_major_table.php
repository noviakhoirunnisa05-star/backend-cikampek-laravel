<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('scholarship_major', function (Blueprint $table) {
            $table->id('id_scholarship_major');
            $table->unsignedBigInteger('id_scholarship');
            $table->unsignedBigInteger('id_major');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scholarship_major');
    }
};