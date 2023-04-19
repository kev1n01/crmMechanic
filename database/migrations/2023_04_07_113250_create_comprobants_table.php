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
            $table->string('tipoDocClient');
            $table->string('numDoc');
            $table->string('rznSocialClient');
            $table->string('direccionClient');
            $table->string('provinciaClient');
            $table->string('departamentoClient');
            $table->string('distritoClient');
            $table->string('ubigueoClient');
            //data company
            $table->string('ruc');
            $table->string('razonSocialCompany');
            $table->string('nombreComercialCompany');
            $table->string('direccionCompany');
            $table->string('provinciaCompany');
            $table->string('departamentoCompany');
            $table->string('distritoCompany');
            $table->string('ubigueoCompany');
            //data invoice amount
            $table->decimal('mtoOperGravadas', 10, 2);
            $table->decimal('mtoOperExoneradas', 10, 2);
            $table->integer('mtoIGV');
            $table->string('totalImpuestos');
            $table->decimal('valorVenta', 10, 2);
            $table->decimal('subTotal', 10, 2);
            $table->decimal('mtoImpVenta', 10, 2);
            //data legend
            $table->string('code');
            $table->string('value');
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
