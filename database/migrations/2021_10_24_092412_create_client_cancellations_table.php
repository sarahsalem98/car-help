<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientCancellationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_cancellations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cancel_id');
            $table->foreign('cancel_id')->references('id')->on('cancellation_reasons')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('public_private_orders')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('client_cancellations');
    }
}
