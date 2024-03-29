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
            $table->foreignId('customer_id')->constrained('customers'); //client
            $table->string('code_sale')->unique();
            $table->decimal('total', 10, 2)->nullable();
            $table->decimal('cash', 10, 2)->nullable();
            $table->string('type_sale')->nullabe();
            $table->string('method_payment')->nullabe();
            $table->string('type_payment')->nullabe();
            $table->date('date_sale')->nullable();
            $table->text('observation')->nullable();
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
