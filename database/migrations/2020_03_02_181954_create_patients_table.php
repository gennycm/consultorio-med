<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('first_lastname');
            $table->string('second_lastname');
            $table->string('street');
            $table->string('number');
            $table->integer('crossing_1');
            $table->integer('crossing_2');
            $table->string('street_name');
            $table->integer('postal_code');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('cellphone');
            $table->string('email');
            $table->string('RFC');
            $table->integer('p_phys')->nullable();
            $table->integer('p_moral')->nullable();
            $table->string('trade_name')->nullable();
            $table->integer('is_surrogate')->nullable();
            $table->unsignedBigInteger('surrogate_id')->nullable(); //TO DO: mark as FK later

            $table->foreign('surrogate_id')
                ->references('id')
                ->on('institutions');

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
        Schema::dropIfExists('patients');
    }
}
