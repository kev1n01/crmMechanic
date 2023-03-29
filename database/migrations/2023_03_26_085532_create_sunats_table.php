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
            $table->string('ruc');
            $table->string('social_reason');
            $table->string('user_sol_secondary');
            $table->string('password_sol_secondary');
            $table->string('address');
            $table->string('certificate');
            $table->string('certificate_password');
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
