<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('undangans', function (Blueprint $table) {
            $table->string('nomor_surat')->nullable()->after('template_id');
            $table->string('jabatan_penerima')->nullable();
            $table->string('instansi_penerima')->nullable();
            $table->string('agenda_rapat')->nullable();
            $table->string('jabatan_pengirim')->nullable();
            $table->string('dresscode')->nullable();
        });
    }

public function down()
{
    Schema::table('undangans', function (Blueprint $table) {
        $table->dropColumn([
            'nomor_surat', 'jabatan_penerima', 'instansi_penerima', 
            'agenda_rapat', 'jabatan_pengirim', 'dresscode'
        ]);
    });
}
};