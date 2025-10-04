<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::create('rentals', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('client_id');
        $table->unsignedBigInteger('car_id');
        $table->dateTime('start_date');
        $table->dateTime('expected_end_date');
        $table->dateTime('actual_end_date')->nullable();
        $table->float('daily_rate', 8,2);
        $table->integer('start_km');
        $table->integer('end_km')->nullable();
        $table->timestamps();

        //foreign key (constraints)
        $table->foreign('client_id')->references('id')->on('clients');
        $table->foreign('car_id')->references('id')->on('cars');
    });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rentals');
    }
}
