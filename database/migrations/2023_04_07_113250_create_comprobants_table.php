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
        Schema::create('comprobants', function (Blueprint $table) {
            $table->id();
            //data comprobant
            $table->string('tipoDoc');
            $table->string('serie');
            $table->string('correlativo');
            $table->date('fechaEmision');
            $table->string('moneda');
            $table->string('tipoPago');
            //data client
            $table->json('cliente');
            //data company
            $table->json('empresa');
            //data items
            $table->json('items');
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
        Schema::dropIfExists('comprobants');
    }
};
