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
        Schema::create('sunats', function (Blueprint $table) {
            $table->id();
            $table->string('ruc')->nullable();
            $table->string('social_reason')->nullable();
            $table->string('user_sol_secondary')->nullable();
            $table->string('password_sol_secondary')->nullable();
            $table->string('address')->nullable();
            $table->string('certificate')->nullable();
            $table->string('certificate_password')->nullable();
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
        Schema::dropIfExists('sunats');
    }
};
