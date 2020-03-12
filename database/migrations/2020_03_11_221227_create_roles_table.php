<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('c_patient');
            $table->integer('r_patient');
            $table->integer('u_patient');
            $table->integer('d_patient');
            $table->integer('admin_roles');
            $table->integer('c_institution');
            $table->integer('r_institution');
            $table->integer('u_institution');
            $table->integer('d_institution');
            $table->integer('c_user');
            $table->integer('r_user');
            $table->integer('u_user');
            $table->integer('d_user');
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
        Schema::dropIfExists('roles');
    }
}
