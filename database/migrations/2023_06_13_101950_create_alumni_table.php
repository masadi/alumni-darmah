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
        Schema::create('alumni', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('nik');
            $table->string('hp');
            $table->string('alamat');
            $table->char('provinsi_id', 2);
            $table->char('kabupaten_id', 4);
            $table->char('kecamatan_id', 7);
            $table->char('desa_id', 10);
            $table->char('tahun_masuk', 4);
            $table->char('tahun_keluar', 4)->nullable();
            $table->timestamps();
            $table->foreign('provinsi_id')->references('code')->on(config('laravolt.indonesia.table_prefix').'provinces')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('kabupaten_id')->references('code')->on(config('laravolt.indonesia.table_prefix').'cities')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('kecamatan_id')->references('code')->on(config('laravolt.indonesia.table_prefix').'districts')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('desa_id')->references('code')->on(config('laravolt.indonesia.table_prefix').'villages')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumni');
    }
};
