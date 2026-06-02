<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id('id_article');

            $table->unsignedBigInteger('id_admin');

            $table->string('judul');
            $table->text('isi_artikel');
            $table->string('gambar')->nullable();

            $table->timestamps();

            $table->foreign('id_admin')
                ->references('id_user')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};