<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntrantesTable extends Migration
{
    public function up()
    {
        Schema::create('entrantes', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('restaurant_id');
            $table->foreign('restaurant_id')->references('id')->on('restaurants');
            $table->string('nombre')->nullable()->comment('Nombre del plato');
            $table->integer('precio')->nullable()->comment('precio del plato');
            $table->string('imagen')->nullable()->comment('imagen del plato');
            $table->string('categoria')->nullable()->comment('Categoría del plato');
            $table->text('descripcion')->nullable()->comment('Descripción del plato');
            $table->string('status')->default(1)->comments('1 aparecera en el buscador. 2 no.');

            $table->foreign('restaurants_id')->references('id')->on('restaurants');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('entrantes');
    }
}
