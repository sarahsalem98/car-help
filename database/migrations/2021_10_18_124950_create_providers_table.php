<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers', function (Blueprint $table) {
            $table->id();
            $table->text('workshop_photo_path');
            $table->string('enginner_name');
            $table->unsignedBigInteger('phone_number');
            $table->unsignedBigInteger('whatsapp_number');
            $table->string('api_token',100)->unique();
            $table->string('email');
            $table->string('password');
            $table->text('business_registeration_file');
            $table->boolean('agreed');
            $table->string('next_step');
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
        Schema::dropIfExists('providers');
    }
}
