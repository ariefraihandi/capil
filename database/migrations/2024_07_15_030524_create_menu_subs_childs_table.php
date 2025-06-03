<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuSubsChildsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_subs_childs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_submenu');
            $table->foreign('id_submenu')->references('id')->on('menu_subs')->onDelete('cascade');
            $table->string('title', 255);
            $table->unsignedInteger('order');
            $table->string('url', 255);
            $table->tinyInteger('is_active')->default(1);
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
        Schema::dropIfExists('menu_subs_childs');
    }
}
