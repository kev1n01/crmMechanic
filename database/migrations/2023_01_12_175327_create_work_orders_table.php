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
        Schema::create('work_orders', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('odo');
            $table->date('arrival_date')->nullable();
            $table->time('arrival_hour')->nullable();
            $table->date('departure_date')->nullable();
            $table->time('departure_hour')->nullable();
            $table->date('date_emission')->nullable();
            $table->decimal('total', 10, 2)->nullable();
            $table->text('observation')->nullable();
            $table->foreignId('customer')->constrained('customers');
            $table->string('status')->nullable();
            $table->integer('is_confirmed'); // 0 = no, 1 = yes
            $table->string('type_atention')->nullable();
            $table->foreignId('vehicle')->constrained('vehicles');
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
        Schema::dropIfExists('work_orders');
    }
};
