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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('provider_id')->nullable()->constrained();
            $table->decimal('total',10,2)->nullable();
            $table->string('code_purchase')->unique();
            $table->date('date_purchase')->nullable();
            $table->string('method_payment')->nullable();
            $table->string('type_cpe')->nullable();
            $table->string('nro_cpe')->nullable();
            $table->text('observation')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('purchases');
    }
};
