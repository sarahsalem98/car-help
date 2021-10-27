<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
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
            $table->unsignedBigInteger('provider_id')->nullable();
            $table->foreign('provider_id')->references('id')->on('providers')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('car_id')->nullable();
            $table->foreign('car_id')->references('id')->on('cars')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('address_id')->nullable();
            $table->foreign('address_id')->references('id')->on('clients_addresses')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedInteger('status')->default(0);
            $table->unsignedInteger('order_type');
            $table->text('details')->nullable();
            $table->text('images')->nullable();
            $table->string('payement_method')->nullable();
        
      
    
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
}
