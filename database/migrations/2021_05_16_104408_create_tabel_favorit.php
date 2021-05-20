<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTabelFavorit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tabel_favorit', function (Blueprint $table) {           
            $table->increments('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('lokasi_id'); 
                    
           
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('lokasi_id')->references('id')->on('lokasi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tabel_favorit');
    }
}
