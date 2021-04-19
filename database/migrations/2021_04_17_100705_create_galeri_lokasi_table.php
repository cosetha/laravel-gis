<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGaleriLokasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galeri_lokasi', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('galeri_id');
            $table->unsignedBigInteger('lokasi_id'); 
                    
           
            $table->foreign('galeri_id')->references('id')->on('galeri')->onDelete('cascade');
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
        Schema::dropIfExists('galeri_lokasi');
    }
}
