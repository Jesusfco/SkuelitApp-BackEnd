<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('patern_surname')->nullable();
            $table->string('matern_surname')->nullable();
            $table->string('email')->unique()->nullable();
            $table->integer('phone')->nullable();
            $table->string('CURP')->unique()->nullable();
            $table->string('password')->nullable();
            $table->integer('group_id')->nullable();
            $table->double('money', 8, 2)->nullable()->default(0);
            $table->text('subjects_id')->nullable();
            $table->text('students_id')->nullable();
            $table->integer('user_type');
            $table->integer('status')->default(1);
            $table->integer('gender');
            $table->integer('address_id')->nullable();
            $table->integer('cash_register_id')->nullable();
            $table->integer('payment_type_id')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
