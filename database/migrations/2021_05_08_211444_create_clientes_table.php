<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->unsignedInteger('id');
            $table->primary('id');
            $table->string('nombre', 100);
            $table->string('apellido', 100);
            $table->string('tipodocumento', 100);
            $table->string('ciudad', 100);
            $table->string('latitud', 100);
            $table->string('longitud', 100);
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
        Schema::dropIfExists('clientes');
    }
}
