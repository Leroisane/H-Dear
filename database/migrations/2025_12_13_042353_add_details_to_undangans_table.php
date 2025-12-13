<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up() {
        Schema::table('undangans', function (Blueprint $table) {
         if (!Schema::hasColumn('undangans', 'pesan_tambahan')) {
            $table->text('pesan_tambahan')->nullable();
        } else {
            $table->text('pesan_tambahan')->nullable()->change();
        }

        if (!Schema::hasColumn('undangans', 'dresscode')) {
            $table->string('dresscode')->nullable();
        } else {
            $table->string('dresscode')->nullable()->change();
        }
    });
}

    public function down(): void
    {
        Schema::table('undangans', function (Blueprint $table) {
            //
        });
    }
};
