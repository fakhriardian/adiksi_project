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
        Schema::create('landing_pages', function (Blueprint $table) {
            $table->id();
            $table->text('hero_image');
            $table->string('hero_caption');
            $table->string('hero_head');
            $table->text('hero_desc');
            $table->text('card_image');
            $table->string('card_head');
            $table->text('card_desc');
            $table->text('card_quote');
            $table->string('hl_head');
            $table->text('hl_desc');
            $table->text('hl_image1');
            $table->string('hl_capt1');
            $table->text('hl_image2');
            $table->string('hl_capt2');
            $table->text('hl_image3');
            $table->string('hl_capt3');
            $table->text('hl_image4');
            $table->string('hl_capt4');
            $table->string('mt_image');
            $table->text('mt_head');
            $table->text('mt_desc');
            $table->text('image1');
            $table->text('image2');
            $table->text('image3');
            $table->text('image4');
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
        Schema::dropIfExists('landing_pages');
    }
};
