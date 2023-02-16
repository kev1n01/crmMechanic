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
        Schema::create('due_pays', function (Blueprint $table) {
            $table->id();
            $table->string('description')->nullable();
            $table->string('person_owed')->nullable();
            $table->float('amount_owed')->nullable();
            $table->float('amount_paid')->nullable();
            $table->string('reason')->nullable();
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
        Schema::dropIfExists('due_pays');
    }
};
