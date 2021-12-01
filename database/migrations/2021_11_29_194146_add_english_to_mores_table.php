<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEnglishToMoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mores', function (Blueprint $table) {
          $table->text('how_to_use_en')->nullable()->after('how_to_use');
          $table->text('who_are_we_en')->nullable()->after('who_are_we');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mores', function (Blueprint $table) {
            //
        });
    }
}
