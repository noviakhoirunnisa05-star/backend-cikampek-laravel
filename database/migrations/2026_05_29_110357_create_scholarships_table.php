<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('scholarships', function (Blueprint $table) {
            $table->id('id_scholarship');

            $table->unsignedBigInteger('id_admin');
            $table->unsignedBigInteger('id_level');

            $table->string('nama_beasiswa');
            $table->string('penyelenggara');
            $table->text('deskripsi');
            $table->text('persyaratan');
            $table->integer('semester_min');
            $table->integer('semester_max');
            $table->date('deadline');
            $table->string('link_pendaftaran');
            $table->string('status')->default('aktif');

            $table->timestamps();

            $table->foreign('id_admin')
                ->references('id_user')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('id_level')
                ->references('id_level')
                ->on('education_levels')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scholarships');
    }
};