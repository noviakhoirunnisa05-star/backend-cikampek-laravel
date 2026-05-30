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
    Schema::create('faqs', function (Blueprint $table) {
        $table->id('id_faq');
        $table->unsignedBigInteger('id_admin');
        $table->text('pertanyaan');
        $table->text('jawaban');
        $table->timestamps();

        $table->foreign('id_admin')->references('id_user')->on('users');
    });
}

public function down(): void
{
    Schema::dropIfExists('faqs');
}
};