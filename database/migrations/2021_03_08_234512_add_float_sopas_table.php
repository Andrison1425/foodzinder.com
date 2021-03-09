<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFloatSopasTable extends Migration
{
    public function up()
    {
        Schema::table('sopas', function (Blueprint $table) {
            $table->dropColumn('precio');
        });
        Schema::table('sopas', function (Blueprint $table) {
            $table->float('precio', 8, 2)->nullable()->after('nombre');
        });
    }

    public function down()
    {
        Schema::table('sopas', function (Blueprint $table) {
            $table->dropColumn('precio');
        });
        Schema::table('sopas', function (Blueprint $table) {
            $table->integer('precio')->nullable()->comment('precio del plato entrante');
        });
    }
}
