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
        Schema::create('cabang', function (Blueprint $table) {
            $table->id();
            $table->string('kota_kabupaten');
            $table->text('alamat');
            $table->string('nama_pimpinan');
            $table->string('nib_cabang')->unique();
            $table->string('pdf_nib')->nullable();
            $table->string('pdf_akta_cabang')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cabang');
    }
};
