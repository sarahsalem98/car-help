<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMainServiceIdToUserFavouriteProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_favourite_providers', function (Blueprint $table) {

            $table->unsignedBigInteger('mainService_id')->after('provider_id')->nullable();
            $table->foreign('mainService_id')->references('id')->on('services')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_favourite_providers', function (Blueprint $table) {
            //
        });
    }
}
