<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemohonInformasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemohon_informasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('alamat');            
            $table->string('whatsapp');
            $table->boolean('whatsapp_connected')->default(false);
            $table->string('email')->nullable();
            $table->string('jenis_permohonan')->nullable();
            $table->uuid('jenis_perkara_gugatan')->nullable();
            $table->uuid('jenis_perkara_permohonan')->nullable();
            $table->text('rincian_informasi')->nullable();
            $table->text('tujuan_penggunaan')->nullable();
            $table->string('ubah_status')->nullable();
            $table->unsignedBigInteger('pendidikan'); // Added pendidikan column
            $table->string('NIK')->unique(); // Added NIK column
            $table->integer('umur'); // Added umur column
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']); // Added jenis_kelamin column
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
        Schema::dropIfExists('pemohon_informasi');
    }
}
