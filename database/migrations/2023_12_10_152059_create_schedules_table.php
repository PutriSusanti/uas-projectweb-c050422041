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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            // $table->bigInteger('student_id')->unsigned();
            $table->bigInteger('subject_id')->unsigned();
            $table->string('hari', 255);
            $table->string('jam_mulai', 255);
            $table->string('jam_selesai', 255);
            $table->string('ruangan', 255);
            $table->string('kode_absensi')->default('default_value');
            $table->string('tahun_akademik')->default('default_value');
            $table->string('semester')->default('default_value');
            $table->string('created_by')->default('default_value');
            $table->string('updated_by')->default('default_value');
            $table->string('deleted_by')->default('default_value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
