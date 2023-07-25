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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->nullable();
            $table->string('user_email');
            $table->string('username');
            $table->string('room');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('duration');
            $table->integer('capacity');
            $table->bigInteger('total');
            $table->enum('status', ['unpaid','paid']);
            $table->enum('active', ['1','0']);
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
        Schema::dropIfExists('bookings');
    }
};
