<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDetalisToClientAdsressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients_addresses', function (Blueprint $table) {
            $table->string('name')->after('client_id')->nullable();
            $table->string('phone_number')->after('client_id')->nullable();
            $table->text('notes')->after('client_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('client_adsresses', function (Blueprint $table) {
            //
        });
    }
}
