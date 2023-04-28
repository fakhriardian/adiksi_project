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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('user_email');
            $table->string('user_name');
            $table->string('order_id')->nullable();
            $table->bigInteger('total');
            $table->integer('tableNumber');
            $table->integer('tunai')->default(0);
            $table->integer('change')->default(0);
            $table->string('casheer')->nullable();
            $table->enum('status', ['unpaid','paid']);
            $table->enum('active', ['0','1']);
            $table->string('paymentMethod')->nullable();
            $table->string('timelines_id')->default(0);
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
        Schema::dropIfExists('orders');
    }
};
