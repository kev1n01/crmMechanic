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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('ruc')->nullable();
            $table->string('phone')->nullable();
            $table->string('province')->nullable();
            $table->string('department')->nullable();
            $table->string('district')->nullable();
            $table->string('ubigeous')->nullable();
            $table->string('address')->nullable();
            $table->string('logo',2048)->nullable();
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
        Schema::dropIfExists('companies');
    }
};
