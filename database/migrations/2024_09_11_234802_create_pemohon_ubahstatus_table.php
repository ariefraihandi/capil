<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemohonUbahstatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemohon_ubahstatus', function (Blueprint $table) {
            $table->uuid('id')->primary(); // UUID as the primary key for pemohon_ubahstatus
            $table->unsignedBigInteger('id_pemohon'); // Foreign key referencing the pemohon ID

            // Ubah status fields
            $table->boolean('cheklist_ubah_status')->default(false); // Checkbox for 'Ubah Status'
            $table->string('status_awal')->nullable(); // Status Awal (Status Di KTP)
            $table->string('status_baru')->nullable(); // Status Baru (Setelah Putusan)

            // Ubah alamat fields
            $table->boolean('cheklist_ubah_alamat')->default(false); // Checkbox for 'Ubah Alamat'
            $table->string('jalan_awal')->nullable(); // Jalan Awal
            $table->string('jalan_baru')->nullable(); // Jalan Baru
            $table->string('rt_rw_awal')->nullable(); // RT/RW Awal
            $table->string('rt_rw_baru')->nullable(); // RT/RW Baru
            $table->string('kel_des_awal')->nullable(); // Kel/Des Awal
            $table->string('kel_des_baru')->nullable(); // Kel/Des Baru
            $table->string('kec_awal')->nullable(); // Kecamatan Awal
            $table->string('kec_baru')->nullable(); // Kecamatan Baru
            $table->string('kab_kota_awal')->nullable(); // Kab/Kota Awal
            $table->string('kab_kota_baru')->nullable(); // Kab/Kota Baru
            $table->string('provinsi_awal')->nullable(); // Provinsi Awal
            $table->string('provinsi_baru')->nullable(); // Provinsi Baru
            $table->string('id_sign')->nullable();
            // Additional fields
            $table->string('url_document')->nullable(); // URL for uploaded document
            $table->string('status')->nullable(); // Status field
            $table->text('catatan')->nullable(); // Catatan (notes) field
            $table->timestamps(); // Timestamps (created_at, updated_at)

            // Foreign key constraint to reference pemohon table
            $table->foreign('id_pemohon')->references('id')->on('pemohon_informasi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pemohon_ubahstatus');
    }
}