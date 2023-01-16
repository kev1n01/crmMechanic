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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique()->nullable();
            $table->string('name')->unique();
            $table->integer('stock');
            $table->string('image',2048)->nullable();
            $table->float('sale_price')->nullable();
            $table->float('purchase_price')->nullable();
            $table->string('status')->nullable();
            $table->foreignId('category_products_id')->nullable()->constrained();
            $table->foreignId('brand_products_id')->nullable()->constrained();

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
        Schema::dropIfExists('products');
    }
};
