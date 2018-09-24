<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessHoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_hours', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('business_id');
            $table->string('monday_hours')->nullable;
            $table->string('tuesday_hours')->nullable;
            $table->string('wednesday_hours')->nullable;
            $table->string('thursday_hours')->nullable;
            $table->string('friday_hours')->nullable;
            $table->string('saturday_hours')->nullable;
            $table->string('sunday_hours')->nullable;
            $table->string('bank_hours')->nullable; 
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
        Schema::dropIfExists('business_hours');
    }
}
