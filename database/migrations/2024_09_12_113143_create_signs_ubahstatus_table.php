<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSignsUbahstatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('signs_ubahstatus', function (Blueprint $table) {
            $table->uuid('id')->primary(); // UUID sebagai primary key
            $table->unsignedBigInteger('pemohon_id'); // Foreign key yang mengacu pada id pemohon dari db lain
            $table->text('message'); // Pesan yang ingin disimpan
            $table->timestamps(); // Menambahkan kolom created_at dan updated_at

            // Opsional: Jika ingin menambahkan constraint foreign key (jika database lain berada di server yang sama)
            // $table->foreign('pemohon_id')->references('id')->on('pemohon');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('signs_ubahstatus');
    }
}
