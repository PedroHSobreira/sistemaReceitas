<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //criar esquema
        Schema::create('registro', function (Blueprint $table){
                    $table->increments('id');
                    $table->text('receita');
                    $table->text('quantidade');
                    $table->text('medidas');
                    $table->text('ingredientes');
                    $table->longText('preparo');
                    $table->timestamps();
        });
    }//fim do up

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registro');
    }//fim do down
};
