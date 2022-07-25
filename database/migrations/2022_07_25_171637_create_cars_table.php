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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('number', 20);
            $table->date("year_made");
            $table->string('model', 50);
            $table->double('price', 10, 0);

            // optimizations
            $table->unsignedBigInteger("car_status_id")->nullable();
            $table->unsignedBigInteger("car_management_id")->nullable();
            $table->unsignedBigInteger("prev_car_management_id")->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
};
