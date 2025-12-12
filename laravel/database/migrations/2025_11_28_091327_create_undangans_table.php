<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('undangans', function (Blueprint $table) {
        $table->id();
        $table->foreignId('template_id')->constrained()->onDelete('cascade');
        $table->string('nama_pengirim');
        $table->string('nama_acara');
        $table->string('tempat_acara');
        $table->dateTime('tanggal_acara');
        $table->string('tujuan_undangan');
        $table->text('pesan_tambahan')->nullable();
        $table->string('nama_user');
        $table->string('email_user')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('undangans');
    }
};