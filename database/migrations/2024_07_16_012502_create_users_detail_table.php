<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('nip')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('tlahir')->nullable();
            $table->date('tglahir')->nullable();
            $table->enum('kelamin', ['L', 'P'])->nullable();
            $table->text('alamat')->nullable();
            $table->string('instansi')->nullable();
            $table->string('iguser')->nullable();
            $table->string('fbuser')->nullable();
            $table->string('twuser')->nullable();
            $table->string('ttuser')->nullable();
            $table->timestamp('lastmodified')->useCurrent();
            $table->string('posisi')->nullable();
            $table->string('key')->nullable();
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
        Schema::dropIfExists('users_detail');
    }
}
