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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(); //seller
            $table->foreignId('customer_id')->constrained('users'); //client
            $table->string('code_sale')->unique();
            $table->decimal('total', 10, 2)->nullable();    
            $table->integer('quantity')->nullable();
            $table->decimal('cash', 10, 2)->nullable();
            $table->decimal('change', 10, 2)->nullable();
            $table->date('date_sale')->nullable();
            $table->string('status')->nullabe();
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
        Schema::dropIfExists('sales');
    }
};
