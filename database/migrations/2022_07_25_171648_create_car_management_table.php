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
        Schema::create('car_management', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('car_id');
            $table->unsignedBigInteger('departament_id')->nullable();
            $table->unsignedBigInteger("user_id")->nullable();
            $table->date("date_from");
            $table->date("date_to");

            $table->index(["date_from", "date_to"]);

            $table->index(["car_id"]);

            $table->index(["car_id", "date_from", "date_to"]);

            $table->index(["user_id", "date_from", "date_to"]);

            $table->index(["user_id"]);
            $table->index(["departament_id"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('car_management');
    }
};
