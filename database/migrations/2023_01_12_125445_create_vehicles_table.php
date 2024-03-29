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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('license_plate')->unique();
            $table->foreignId('customer_id')->nullable()->constrained('customers')->onDelete('cascade'); //user type customer
            $table->foreignId('type_vehicle')->nullable()->constrained('type_vehicles')->onDelete('cascade');
            $table->foreignId('brand_vehicle')->nullable()->constrained('brand_vehicles')->onDelete('cascade');
            $table->foreignId('model_vehicle')->nullable()->constrained('model_vehicles')->onDelete('cascade');
            $table->foreignId('color_vehicle')->nullable()->constrained('color_vehicles')->onDelete('cascade');
            $table->string('model_year')->nullable();
            $table->string('odo')->nullable();
            $table->string('image',2048)->nullable();
            $table->text('description',300)->nullable();
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
        Schema::dropIfExists('vehicles');
    }
};
