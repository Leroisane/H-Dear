<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('undangans', function (Blueprint $table) {
            $table->string('topik_acara')->nullable(); // Buat Judul Materi atau Kategori Lomba
            $table->string('link_dokumen')->nullable(); // Buat Link Drive (TOR/Rubrik/Rundown)
        });
    }

    public function down()
    {
        Schema::table('undangans', function (Blueprint $table) {
            $table->dropColumn(['topik_acara', 'link_dokumen']);
        });
    }
};