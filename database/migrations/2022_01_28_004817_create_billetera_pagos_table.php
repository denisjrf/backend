<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBilleteraPagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billeterapagos', function (Blueprint $table) {
            $table->id();
            $table->integer('id_session');
            $table->integer('token');
            $table->double('monto');
            $table->string('documento');
            $table->string('celular');
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
        Schema::dropIfExists('billetera_pagos');
    }
}
