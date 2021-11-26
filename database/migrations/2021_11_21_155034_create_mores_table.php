<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mores', function (Blueprint $table) {
            $table->id();
            $table->text('banners_pics')->nullable();
            $table->text('coupons')->nullable();
            $table->string('commission')->nullable();
            $table->text('how_to_use')->nullable();
            $table->text('who_are_we')->nullable();
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
        Schema::dropIfExists('mores');
    }
}
